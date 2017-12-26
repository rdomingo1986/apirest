<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

	public function __construct() {
    parent::__construct();
  }

  public function getCategoriesListByAgencyId($args) {
    $this->custom_form_validation->validate($args, 'get-category-list-by-agency-id');

    $this->db->select('
      category.id AS categoryId,
      category.name AS categoryName,
      category.description AS categoryDescription,
      IF(category.discount IS NULL, 0, category.discount) AS categoryDiscount,
      IF(category.commission IS NULL, 0, category.commission) AS categoryCommission
    ')
      ->from('category')
      ->where('category.agency_id', $args['agencyId']);
    if($args['keyword'] != null && $args['keyword'] != 'null') {
      $this->db->group_start()
        ->like('category.name', urldecode($args['keyword']))
        ->or_like('category.description', urldecode($args['keyword']))
        ->group_end();
    }
    if($args['byFilter'] == null || $args['byFilter'] == 'null') {
      $filter = 'category.id';
    } else {
      $filter = 'category.' . $args['byFilter'];
    }
    if($args['orderBy'] == 'null' || $args['orderBy'] == 'ascendente' || $args['orderBy'] == null) {
      $this->db->order_by($filter, 'ASC');
    } else {
      $this->db->order_by($filter, 'DESC');
    }
    return $this->db->limit($args['limit'], $args['offset'])
      ->get()
      ->result();
  }

  public function getCategoriesComboByAgencyId($agencyId) {
    $this->custom_form_validation->validate([ 'id' => $agencyId ], 'get-categories-combo-by-agency-id');

    return $this->db->select('
      category.id AS categoryId,
      category.name AS categoryName,
      category.discount AS categoryDiscount,
      category.commission AS categoryCommission
    ')
      ->from('category')
      ->where('agency_id', $agencyId)
      ->get()
      ->result();
  }

  public function createNewCategory($args) {
    $this->custom_form_validation->validate($args, 'create-new-category');

    is_uniquevalue([
      'table' => 'category',
      'column' => 'name',
      'column_owner' => 'agency_id', 
      'value' => $args['name'],
      'owner_id' => $args['agencyId']
    ]);

    $this->db->insert('category', [
      'agency_id' => $args['agencyId'],
      'name' => $args['name'],
      'description' => $args['description'],
      'discount' => $args['discount'],
      'commission' => $args['commission']
    ]);

    return true;
  }

  public function editCategoryData($args) {
    // $this->custom_form_validation->validate($args, $args['validationRule']);

    is_uniquevalue([
      'table' => 'category',
      'column' => 'name',
      'column_owner' => 'agency_id', 
      'id' => $args['id'],
      'value' => $args['name'],
      'owner_id' => $args['agency_id']
    ]);

    return $this->db->where('id', $args['id'])
      ->update('category', [
        'name' => $args['name'],
        'description' => $args['description'],
        'discount' => $args['discount'],
        'commission' => $args['commission']
      ]);
  }

  public function deleteCategoryById($categoryId, $agencyId) {
    // validar

    $this->db->where('id', $categoryId)
      ->delete('category');

    return $this->getCategoriesListByAgencyId([
      'limit' => 12,
      'offset' => 0,
      'keyword' => 'null',
      'byFilter' => 'null',
      'orderBy' => 'null',
      'agencyId' => $agencyId
    ]);
  }
}
