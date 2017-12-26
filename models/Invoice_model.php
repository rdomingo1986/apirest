<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_model extends CI_Model {

	public function __construct() {
    parent::__construct();
    $this->load->model('ItemInvoice_model', 'iteminvoice');
  }

  public function getInvoicesListByAgencyId($args) {
    // $this->custom_form_validation->validate($args, 'get-main-agency-list');
    
    $this->db->select('
      invoice.id AS invoiceId,
      IF(entity.person_type = \'natural\', entity.full_name, entity.company_name) AS entityName,
      invoice.invoice_number AS invoiceNumber,
      invoice.total_amount AS totalAmount,
      invoice.paid_amount AS paidAmount,
      invoice.private_notes AS privateNotes
    ')
      ->from('invoice')
      ->join('entity', 'entity.id=invoice.client_id')
      ->where('entity.parent_id', $args['agencyId']);
    if($args['code'] != null && $args['code'] != 'null') {
      $this->db->like('invoice.invoice_number', urldecode($args['code']));
    }
    if($args['client'] != null && $args['client'] != 'null') {
      $this->db->where('invoice.client_id', $args['client']);
    }
    if($args['status'] != null && $args['status'] != 'null') {
      $this->db->where('invoice.status', $args['status']);
    }
    return $this->db->limit($args['limit'], $args['offset'])
      ->get()
      ->result();
  }

  public function getInvoicesListByClientId($args) {
    $this->db->select('
      invoice.id AS invoiceId,
      IF(entity.person_type = \'natural\', entity.full_name, entity.company_name) AS entityName,
      invoice.invoice_number AS invoiceNumber,
      invoice.total_amount AS totalAmount,
      invoice.paid_amount AS paidAmount,
      invoice.client_notes AS clientNotes,
      invoice.status AS invoiceStatus
    ')
      ->from('invoice')
      ->join('entity', 'entity.id=invoice.client_id')
      ->where('invoice.client_id', $args['clientId']);
    if($args['code'] != null && $args['code'] != 'null') {
      $this->db->like('invoice.invoice_number', urldecode($args['code']));
    }
    if($args['dateRange'] != null && $args['dateRange'] != 'null') {
      $this->db->where('invoice.client_id', $args['dateRange']);
    }
    if($args['status'] != null && $args['status'] != 'null') {
      $this->db->where('invoice.status', $args['status']);
    }
    return $this->db->limit($args['limit'], $args['offset'])
      ->get()
      ->result();
  }

  public function generateInvoice($args) {
    // $this->custom_form_validation->validate($args, 'get-main-agency-list');
    
    $invoiceNumber = $this->db->select('invoice_number')
      ->from('invoice')
      ->order_by('invoice_number','DESC')
      ->limit(1)
      ->get()
      ->row()
      ->invoice_number;

    $this->db->insert('invoice', [
      'client_id' => $args['client_id'],
      'invoice_number' => $invoiceNumber === null ? 1 : $invoiceNumber + 1,
      'total_amount' => $args['total_amount'],
      'client_notes' => strlen($args['client_notes']) === 0 ? NULL : $args['client_notes'],
      'private_notes' => strlen($args['private_notes']) === 0 ? NULL : $args['private_notes'],
      'register_date' => date('Y-m-d H:i:s', time())
    ]);

    $args['invoice_id'] = $this->db->insert_id();

    $this->iteminvoice->registerInvoiceItems($args);

    //enviar email al cliente
    return true;
  }

  public function getInvoiceDetailsById($invoiceId) {
    $invoceData = $this->db->select('
      invoice.id AS invoiceId,
      invoice.invoice_number AS invoiceNumber,
      invoice.total_amount AS totalAmount,
      invoice.paid_amount AS paidAmount,
      invoice.client_notes AS clientNotes,
      invoice.status AS invoiceStatus
    ')
      ->from('invoice')
      ->join('entity', 'entity.id=invoice.client_id')
      ->where('invoice.id', $invoiceId)
      ->get()
      ->row();

    $invoiceItemsData = $this->db->select('
      item_invoice.id AS itemInvoiceId,
      item_invoice.item_name AS itemName,
      item_invoice.item_description AS itemDescription,
      item_invoice.item_price_in_cash AS itemPriceInCash,
      item_invoice.item_discount AS itemDiscount,
      item_invoice.item_quantity AS itemQuantity,
      item_import AS itemImport
    ')
      ->from('item_invoice')
      ->where('item_invoice.invoice_id', $invoiceId)
      ->get()
      ->result();

    return [
      $invoceData,
      $invoiceItemsData
    ];
  }

  public function deleteInvoiceById($invoiceId, $agencyId) {
    // validar

    $this->db->where('id', $invoiceId)
      ->delete('invoice');

    return $this->getInvoicesListByAgencyId([
      'limit' => 12,
      'offset' => 0,
      'code' => 'null',
      'client' => 'null',
      'status' => 'null',
      'agencyId' => $agencyId
    ]);
  }
}
