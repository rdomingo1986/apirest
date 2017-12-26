<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ItemInvoice_model extends CI_Model {

	public function __construct() {
    parent::__construct();
  }

  public function registerInvoiceItems($args) {
    foreach($args['item_id'] AS $key => $item) {
      $this->db->insert('item_invoice', [
        'invoice_id' => $args['invoice_id'],
        'item_name' => $args['item_name'][$key],
        'item_description' => $args['item_description'][$key],
        'item_price_in_cash' => $args['item_price_in_cash'][$key],
        'item_discount' => $args['item_discount'][$key],
        'item_quantity' => $args['item_quantity'][$key],
        'item_import' => $args['item_import'][$key]
      ]);
    }
    return true;
  }
}
