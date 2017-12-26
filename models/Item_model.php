<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_model extends CI_Model {

	public function __construct() {
    parent::__construct();
    $this->load->model('User_model', 'user');
    $this->load->model('ItemEntity_model', 'itementity');
  }

  public function getItemsListByAgencyId($args) {
    // $this->custom_form_validation->validate($args, 'get-item-list-by-agency-id');
    $this->db->select('
      item_entity.id AS itemId,
      item.name AS itemName,
      item.description AS itemDescription,
      item.item_type AS itemType,
      item_entity.price_in_cash AS itemPriceInCash,
      item_entity.commission AS itemCommission,
      IF(item_entity.is_owner = 1, \'OWN\', \'ASSIGNED\') AS itemCondition
    ')
      ->from('item')
      ->join('item_entity','item.id=item_entity.item_id')
      ->where('item_entity.entity_id', $args['agencyId']);
    if($args['itemCondition'] == null || $args['itemCondition'] == 'null' || $args['itemCondition'] == 'propio') {
      $this->db->where('item_entity.is_owner', 1);
      if($args['keyword'] != null && $args['keyword'] != 'null') {
        $this->db->group_start()
          ->like('item.name', urldecode($args['keyword']))
          ->or_like('item.description', urldecode($args['keyword']))
          ->group_end();
      }
      if($args['itemType'] != null && $args['itemType'] != 'null') {
        $this->db->where('item.item_type', $args['itemType']);
      }
      if($args['filterCategory'] != null && $args['filterCategory'] != 'null' && is_numeric($args['filterCategory'])) {
        $this->db->where('item.category_id', $args['filterCategory']);
      }
    } else {
      $this->db->where('item_entity.is_owner', 0);
      if($args['keyword'] != null && $args['keyword'] != 'null') {
        $this->db->group_start()
          ->like('item.name', urldecode($args['keyword']))
          ->or_like('item.description', urldecode($args['keyword']))
          ->group_end();
      }
      if($args['itemType'] != null && $args['itemType'] != 'null') {
        $this->db->where('item.item_type', $args['itemType']);
      }
    }
    return $this->db->limit($args['limit'], $args['offset'])
      ->get()
      ->result();
  }

  public function getItemsComboByAgencyId($agencyId) {
    // $this->custom_form_validation->validate($args, 'get-item-list-by-agency-id');

    $userRole = $this->user->getUserRoleByEntityId($agencyId);
    if($userRole == 'superadmin') {
      return $this->db->select('
        item_entity.id AS itemId,
        item.name AS itemName
      ')
        ->from('item')
        ->join('item_entity', 'item_entity.item_id=item.id', 'left')
        ->where([
          'is_owner' => 1,
          'entity_id' => $agencyId
        ])
        ->get()
        ->result();
    } else {
      throw new Exception('No se ha desarrollado la parte para agencias administradas y subagencias');
    }
  }

  public function createNewItem($args) {
    $this->custom_form_validation->validate($args, 'create-new-item');

    is_uniquevalue([
      'table' => 'item',
      'column' => 'name',
      'column_owner' => 'agency_id', 
      'value' => $args['name'],
      'owner_id' => $args['agencyId']
    ]);

    $this->db->insert('item', [
      'agency_id' => $args['agencyId'],
      'category_id' => strlen($args['categoryId']) === 0 ? NULL : $args['categoryId'],
      'name' => $args['name'],
      'description' => $args['description'],
      'item_type' => $args['itemType']
    ]);

    $args['itemId'] = $this->db->insert_id();
    $this->itementity->createNewItemEntity($args);

    return true;
  }

  public function getItemDataById($args) {
    // $this->custom_form_validation->validate($args, 'get-item-data-by-id);
    
    return $this->db->select('
      item_entity.id AS itemId,
      item_entity.item_id AS parentItemId,
      item.category_id AS categoryId,
      item.name AS itemName,
      item.description AS itemDescription,
      item.item_type AS itemType,
      item_entity.price_in_cash AS itemPriceInCash,
      item_entity.commission AS itemCommission,
      item_entity.discount AS itemDiscount,
      item_entity.percent_aum_credit AS itemPercentAumCredit
    ')
      ->from('item')
      ->join('item_entity', 'item_entity.item_id=item.id', 'left')
      ->where('item_entity.id', $args['item_id'])
      ->where('item_entity.entity_id', $args['agency_id'])
      ->get()
      ->row();
  }

  public function getItemAssignmentsById($args) {
    // $this->custom_form_validation->validate($args, 'get-item-assignments-by-id);

    return $this->db->select('
      item_entity.id AS itemEntityId,
      IF(entity.person_type = \'natural\', entity.full_name, entity.company_name) AS entityName,
      IF(entity.type = \'agencia\', \'Agencia\', \'Sub-agencia\') AS entityType,
      IF(entity.parent_id IS NULL, \'\', IF(a.person_type = \'natural\', a.full_name, a.company_name)) AS entityParentName,
      item_entity.commission AS itemCommission,
      item_entity.entity_id AS entityId
    ')
      ->from('entity')
      ->join('entity AS a', 'a.id=entity.parent_id', 'left')
      ->join('item_entity','item_entity.entity_id=entity.id','left')
      ->where('item_entity.parent_id', $args['item_id'])
      ->where('item_entity.is_owner', 0)
      ->order_by('entityType','ASC')
      ->get()
      ->result();
  }

  public function deleteItemById($itemId, $agencyId, $itemCondition) {
    // $this->custom_form_validation->validate($args, 'delete-item');

    $parentItemId = $this->itementity->isParentItemEntity($itemId);
    if($parentItemId != null) {
      $this->db->where('id', $parentItemId->item_id)
        ->delete('item');
    } else {
      $this->db->where('id', $itemId)
        ->delete('item_entity');
    }
    
    return $this->getItemsListByAgencyId([
      'limit' => 12,
      'offset' => 0,
      'keyword' => 'null',
      'itemType' => 'null',
      'filterCategory' => 'null',
      'itemCondition' => $itemCondition,
      'agencyId' => $agencyId
    ]);
  }

  public function deleteItemAssignmentById($itemEntityId, $agencyId, $itemId) {
    // $this->custom_form_validation->validate($args, 'delete-item');

    $this->db->where('id', $itemEntityId)
      ->delete('item_entity');
    
    return $this->getItemAssignmentsById([
      'item_id' => $itemId,
      'agency_id' => $agencyId
    ]);
  }

  public function editItemAssignmentCommission($args) {
    // $this->custom_form_validation->validate($args, 'delete-item');

    $this->db->where('id', $args['id'])
      ->update('item_entity', [
        'commission' => $args['commission']
      ]);
    
      return (int)$args['commission'];
  }
}
