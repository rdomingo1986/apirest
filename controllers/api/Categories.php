<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->model('Category_model', 'category');
  }

  public function index() {
    echo base_url();
  }

  public function getCategoriesListByAgencyId($limit, $offset, $keyword, $byFilter, $orderBy, $agencyId) {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);

    echo json_encode($this->category->getCategoriesListByAgencyId([
      'limit' => $limit,
      'offset' => $offset,
      'keyword' => $keyword,
      'byFilter' => $byFilter,
      'orderBy' => $orderBy,
      'agencyId' => $agencyId
    ]));
  }

  public function getCategoriesComboByAgencyId($agencyId) {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);

    echo json_encode($this->category->getCategoriesComboByAgencyId(
      $agencyId
    ));
  }

  public function categoryIsUnique() {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);

    echo json_encode(is_uniquevalue([
      'table' => 'category',
      'column' => 'name',
      'value' => $this->input->post('name'),
      'id' => $this->input->post('id') != null ? $this->input->post('id') : false,
      'owner_id' => $this->input->post('agencyId') != null ? $this->input->post('agencyId') : false,
      'column_owner' => 'agency_id', 
      'ajax-validation' => true
    ]));
  }

  public function createNewCategory() {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);

    echo json_encode($this->category->createNewCategory([
      'agencyId' => $this->input->post('agencyId'),
      'name' => trim($this->input->post('name')),
      'description' => trim($this->input->post('description')),
      'discount' => sprintf("%.2f", trim($this->input->post('discount'))),
      'commission' => sprintf("%.2f", trim($this->input->post('commission')))
    ]));
  }

  public function editCategoryData() {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);

    echo json_encode($this->category->editCategoryData([
      'id' => $this->input->post('categoryId'),
      'agency_id' => $this->input->post('agencyId'),
      'name' => $this->input->post('name'),
      'description' => $this->input->post('description'),
      'discount' => $this->input->post('discount'),
      'commission' => $this->input->post('commission')
    ]));
  }

  public function deleteCategoryById($categoryId, $agencyId) {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);

    echo json_encode($this->category->deleteCategoryById(
      $categoryId, 
      $agencyId
    ));
  }
}
