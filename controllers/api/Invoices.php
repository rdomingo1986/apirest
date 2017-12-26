<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoices extends CI_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->model('Invoice_model', 'invoice');
  }

  public function index() {
    echo base_url();
  }

  public function getInvoicesListByAgencyId($limit, $offset, $code, $client, $status, $agencyId) {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);

    echo json_encode($this->invoice->getInvoicesListByAgencyId([
      'limit' => $limit,
      'offset' => $offset,
      'code' => $code,
      'client' => $client,
      'status' => $status,
      'agencyId' => $agencyId
    ]));
  }

  public function getInvoicesListByClientId($limit, $offset, $code, $status, $dateRange, $clientId = null) {
    $this->custom_session->apiIsLoggedIn();

    echo json_encode($this->invoice->getInvoicesListByClientId([
      'limit' => $limit,
      'offset' => $offset,
      'code' => $code,
      'status' => $status,
      'dateRange' => $dateRange,
      'clientId' => $clientId == null ? $this->session->clientId : $clientId
    ]));
  }

  public function generateInvoice() {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);

    echo json_encode($this->invoice->generateInvoice([
      'item_id' => $this->input->post('itemId'),
      'item_name' => $this->input->post('itemName'),
      'item_description' => $this->input->post('itemDescription'),
      'item_price_in_cash' => $this->input->post('itemPriceInCash'),
      'item_discount' => $this->input->post('itemDiscount'),
      'item_quantity' => $this->input->post('quantity'),
      'item_import' => $this->input->post('import'),
      'total_amount' => trim($this->input->post('invoiceTotal')),
      'subtotal_amount' => trim($this->input->post('invoiceSubTotal')),
      'client_id' => trim($this->input->post('clientId')),
      'private_notes' => trim($this->input->post('privateNotes')),
      'client_notes' => trim($this->input->post('clientNotes'))
    ]));
  }

  public function getInvoiceDetailsById($invoiceId) {
    $this->custom_session->apiIsLoggedIn();

    echo json_encode($this->invoice->getInvoiceDetailsById(
      $invoiceId
    ));
  }

  public function deleteInvoiceById($invoiceId, $agencyId) {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);

    echo json_encode($this->invoice->deleteInvoiceById(
      $invoiceId, 
      $agencyId
    ));
  }
}
