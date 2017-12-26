<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ItemEntity_model extends CI_Model {

	public function __construct() {
    parent::__construct();
    $this->load->model('Item_model', 'item');
  }

  public function createNewItemEntity($args) {
    $this->db->insert('item_entity', [
      'item_id' => $args['itemId'],
      'entity_id' => $args['agencyId'],
      'price_in_cash' => $args['priceInCash'],
      'percent_aum_credit' => $args['percentAumCredit'],
      'discount' => $args['discount'], 
      'commission' => $args['commission']
    ]);
    $parentId = $this->db->insert_id();
    if($args['agenciesList'] != null && gettype($args['agenciesList']) === 'array') {
      foreach($args['agenciesList'] AS $agencyId) {
        if($agencyId != $args['agencyId']) {
          $this->db->insert('item_entity', [
            'item_id' => $args['itemId'],
            'parent_id' => $parentId,
            'entity_id' => $agencyId,
            'price_in_cash' => $args['priceInCash'],
            'percent_aum_credit' => $args['percentAumCredit'],
            'discount' => $args['discount'], 
            'commission' => $args['commission'],
            'is_owner' => 0
          ]);
        }
      }
    }
    return true;
  }

  public function deleteItemEntityById($args) {
    // $this->custom_form_validation->validate($args, 'delete-item-entity');

    $this->db->where('id', $args['itementity_id'])
      ->delete('item_entity');

    return $this->item->getItemAssignmentsById($args);
  }

  public function assignEntitiesToItem($args) {
    // $this->custom_form_validation->validate($args, 'assign-entities-to-item');

    $itemData = $this->item->getItemDataById($args);
    $itemId = $this->getItemIdById($args['item_id']);
    foreach($args['agenciesList'] AS $agencyId) {
      $this->db->insert('item_entity', [
        'parent_id' => $args['item_id'],
        'item_id' => $itemId,
        'entity_id' => $agencyId,
        'price_in_cash' => $itemData->itemPriceInCash,
        'percent_aum_credit' => $itemData->itemPercentAumCredit,
        'discount' => $itemData->itemDiscount,
        'commission' => $itemData->itemCommission,
        'is_owner' => 0
      ]);
    }

    return $this->item->getItemAssignmentsById($args);
  }

  public function getItemIdById($itemEntityId) {
    return $this->db->select('item_id')
      ->from('item_entity')
      ->where('id', $itemEntityId)
      ->get()
      ->row()
      ->item_id;
  }

  public function isParentItemEntity($itemId) {
    return $this->db->select('item_id')
      ->from('item_entity')
      ->where([
        'id' => $itemId,
        'is_owner' => 1
      ])
      ->get()
      ->row();
  }

  public function isItemOwner($args) {
    return $this->db->select('id')
      ->from('item_entity')
      ->where([
        'id' => $args['item_id'],
        'entity_id' => $args['agency_id'],
        'is_owner' => 1
      ])
      ->get()
      ->row()
      ->id;
  }
}
