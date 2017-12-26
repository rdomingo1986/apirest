<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->model('Item_model', 'item');
    $this->load->model('ItemEntity_model', 'itementity');
  }

  public function index() {
    echo base_url();
  }

  public function getItemsListByAgencyId($limit, $offset, $keyword, $itemType, $filterCategory, $itemCondition, $agencyId) {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);

    echo json_encode($this->item->getItemsListByAgencyId([
      'limit' => $limit,
      'offset' => $offset,
      'keyword' => $keyword,
      'itemType' => $itemType,
      'filterCategory' => $filterCategory,
      'itemCondition' => $itemCondition,
      'agencyId' => $agencyId
    ]));
  }

  public function getItemsComboByAgencyId($agencyId) {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);

    echo json_encode($this->item->getItemsComboByAgencyId(
      $agencyId
    ));
  }

  public function itemIsUnique() {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);

    echo json_encode(is_uniquevalue([
      'table' => 'item',
      'column' => 'name',
      'value' => $this->input->post('name'),
      'id' => $this->input->post('id') != null ? $this->input->post('id') : false,
      'owner_id' => $this->input->post('agencyId') != null ? $this->input->post('agencyId') : false,
      'column_owner' => 'agency_id', 
      'ajax-validation' => true
    ]));
  }

  public function createNewItem() {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);
      
    echo json_encode($this->item->createNewItem([
      'agencyId' => trim($this->input->post('agencyId')),
      'categoryId' => trim($this->input->post('categoryId')),
      'name' => trim($this->input->post('name')),
      'description' => trim($this->input->post('description')),
      'priceInCash' => sprintf("%.2f", trim($this->input->post('priceInCash'))),
      'percentAumCredit' => sprintf("%.2f", trim($this->input->post('percentAumCredit'))),
      'itemType' => trim($this->input->post('itemType')),
      'discount' => sprintf("%.2f", trim($this->input->post('discount'))),
      'commission' => sprintf("%.2f", trim($this->input->post('commission'))),
      'agenciesList' => $this->input->post('agenciesList')
    ]));
  }

  public function getItemDataById($itemId, $agencyId) {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);

    echo json_encode($this->item->getItemDataById([
      'item_id' => $itemId,
      'agency_id' => $agencyId
    ]));
  }

  public function editOwnItemData() {
    // originalItemId se usar para modificar los datos principales e itemId para los datos en item_entidad
    echo json_encode($this->input->post());
  }

  public function getItemAssignmentsById($itemId, $agencyId) {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);

    echo json_encode($this->item->getItemAssignmentsById([
      'item_id' => $itemId,
      'agency_id' => $agencyId
    ]));
  }

  public function deleteItemById($itemId, $agencyId, $itemCondition = 'null') {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);

    echo json_encode($this->item->deleteItemById(
      $itemId, 
      $agencyId,
      $itemCondition
    ));
  }

  public function deleteItemAssignmentById($itemEntityId, $agencyId, $itemId) {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin'
      ]);

    echo json_encode($this->item->deleteItemAssignmentById(
      $itemEntityId, 
      $agencyId,
      $itemId
    ));
  }

  public function assignEntitiesToItem() {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin'
      ]);

    echo json_encode($this->itementity->assignEntitiesToItem([
      'item_id' => trim($this->input->post('itemId')),
      'agenciesList' => $this->input->post('agenciesList'),
      'agency_id' => $this->input->post('agencyId')
    ]));
  }

  public function editItemAssignmentCommission() {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin'
      ]);

    echo json_encode($this->item->editItemAssignmentCommission([
      'id' => $this->input->post('itemId'),
      'commission' => $this->input->post('commissionAssignment')
    ]));
  }
}
