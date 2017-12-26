<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entities extends CI_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->model('Entity_model', 'entity');
  }

  public function index() { }

  public function getMainAgenciesList($limit, $offset, $keyword, $condition, $personType) {
    $this->custom_session->apiIsLoggedIn()
      ->apiIsSuperAdmin();

    echo json_encode($this->entity->getMainAgenciesList([
      'limit' => $limit,
      'offset' => $offset,
      'keyword' => $keyword,
      'condition' => $condition,
      'personType' => $personType,
      'owner_id' => $this->session->userId
    ]));
  }

  public function companyNameIsUnique() {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);

    $this->custom_form_validation->validate($this->input->post(), 'company-name-is-unique');
    
    echo json_encode(is_uniquevalue([
      'table' => 'entity',
      'column' => 'company_name',
      'value' => $this->input->post('companyName'),
      'id' => $this->input->post('id') != null ? $this->input->post('id') : false,
      'ajax-validation' => true
    ]));
  }
  
  public function rfcIsUnique() {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);

    $this->custom_form_validation->validate($this->input->post(), 'rfc-is-unique');
    
    echo json_encode(is_uniquevalue([
      'table' => 'entity',
      'column' => 'rfc',
      'value' => $this->input->post('RFC'),
      'id' => $this->input->post('id') != null ? $this->input->post('id') : false,
      'ajax-validation' => true
    ]));
  }

  public function createMainAgency() {
    $this->custom_session->apiIsLoggedIn()
      ->apiIsSuperAdmin();

    echo json_encode($this->entity->createMainAgency([
      'agency_condition' => trim($this->input->post('agencyCondition')),
      'person_type' => trim($this->input->post('personType')),
      'owner_id' => trim($this->session->userId),
      'email' => trim($this->input->post('email')),
      'first_name' => trim($this->input->post('names')),
      'last_name' => trim($this->input->post('lastNames')),
      'gender' => trim($this->input->post('gender')),
      'phone_number' => trim($this->input->post('phoneNumber')),
      'mobile_number' => trim($this->input->post('mobileNumber')),
      'company_name' => trim($this->input->post('companyName')),
      'rfc' => trim($this->input->post('RFC')),
      'country_id' => trim($this->input->post('country')),
      'state' => trim($this->input->post('state')),
      'city' => trim($this->input->post('city')),
      'address' => trim($this->input->post('address')),
      'zip_code' => trim($this->input->post('zipCode'))
    ]));
  }

  public function getEntityDataById($entityId) {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);

    echo json_encode($this->entity->getEntityDataById([
      'id' => $entityId,
      'owner_id' => $this->session->userId
    ]));
  }

  public function getClientsListByAgencyId($limit, $offset, $keyword, $type, $status, $agencyId) {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);

    echo json_encode($this->entity->getClientsListByAgencyId([
      'parent_id' => $agencyId,
      'limit' => $limit,
      'offset' => $offset,
      'keyword' => $keyword,
      'type' => $type,
      'status' => $status
    ]));
  }

  public function editEntity() {
    $this->custom_session->apiIsLoggedIn()
      ->apiIsSuperAdmin();

    echo json_encode($this->entity->editEntity([
      'owner_id' => trim($this->session->userId),
      'userId' => trim($this->input->post('userId')),
      'agency_condition' => $this->input->post('agencyCondition') == null ? null : trim($this->input->post('agencyCondition')),
      'person_type' => trim($this->input->post('personType')),
      'email' => trim($this->input->post('email')),
      'agency_id' => trim($this->input->post('agencyId')),
      'first_name' => trim($this->input->post('names')),
      'last_name' => trim($this->input->post('lastNames')),
      'gender' => trim($this->input->post('gender')),
      'phone_number' => trim($this->input->post('phoneNumber')),
      'mobile_number' => trim($this->input->post('mobileNumber')),
      'company_name' => trim($this->input->post('companyName')),
      'rfc' => trim($this->input->post('RFC')),
      'country_id' => trim($this->input->post('country')),
      'state' => trim($this->input->post('state')),
      'city' => trim($this->input->post('city')),
      'address' => trim($this->input->post('address')),
      'zip_code' => trim($this->input->post('zipCode'))
    ]));
  }

  public function registerClient() {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);

    echo json_encode($this->entity->registerClient([
      'person_type' => trim($this->input->post('personType')),
      'first_name' => trim($this->input->post('names')),
      'last_name' => trim($this->input->post('lastNames')),
      'email' => trim($this->input->post('email')),
      'password' => substr(random_md5hash(), 0, 8),
      'rfc' => trim($this->input->post('RFC')),
      'company_name' => trim($this->input->post('companyName')),
      'phone_number' => trim($this->input->post('phoneNumber')),
      'mobile_number' => trim($this->input->post('mobileNumber')),
      'gender' => trim($this->input->post('gender')),
      'country_id' => trim($this->input->post('country')),
      'state' => trim($this->input->post('state')),
      'city' => trim($this->input->post('city')),
      'address' => trim($this->input->post('address')),
      'zip_code' => trim($this->input->post('zipCode')),
      'parent_id' => trim($this->input->post('agencyId')),
      'account_status' => 'porcambiarclave',
      'role' => $this->input->post('clientType') == null ? 'cliente' : trim($this->input->post('clientType'))
    ]));
  }

  public function getAgenciesChainByAgencyId($agencyId) {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);

    echo json_encode($this->entity->getAgenciesChainByAgencyId([
      'agencyId' => $agencyId
    ]));
  }

  public function getBreadCrumbInfo($entityId) {
    $this->custom_session->apiIsLoggedIn();

    echo json_encode($this->entity->getBreadCrumbInfo(
      $entityId
    ));
  }

  public function deleteEntityById($entityId, $agencyId = null) {
    $this->custom_session->apiIsLoggedIn()
      ->apiIsSuperAdmin();

    echo json_encode($this->entity->deleteEntityById(
      $entityId,
      $agencyId
    ));
  }






	public function autoRegisterEntity() {
		echo json_encode($this->entity->registerClient([
      'names' => trim($this->input->post('names')),
      'lastNames' => trim($this->input->post('lastNames')),
      'email' => trim($this->input->post('email')),
      'password' => $this->input->post('password'),
      'passwordRepeat' => $this->input->post('passwordRepeat'),
      'gender' => trim($this->input->post('gender')),
      'legalTerms' => trim($this->input->post('legalTerms')),
      'parentAgencyCode' => trim($this->input->post('parentAgencyCode')),
      'accountStatus' => 'autoregistro',
      'role' => 'cliente',
      'validationRule' => 'autoregister-entity'
    ]));
  }
  
  public function activateEntity() {
    $this->custom_session->apiIsLoggedIn()
      ->apiIsAgency();

    echo json_encode($this->entity->activateEntity([
      'clientId' => $this->input->post('clientId'),
      'validationRule' => 'activate-inactivate-entity'
    ]));
  }

  public function inactivateEntity() {
    $this->custom_session->apiIsLoggedIn()
      ->apiIsAgency();
    
    echo json_encode($this->entity->inactivateEntity([
      'clientId' => $this->input->post('clientId'),
      'validationRule' => 'activate-inactivate-entity'
    ]));
  }

  public function approveEntityMembership() {
    $this->custom_session->apiIsLoggedIn()
      ->apiIsAgency();
    
    echo json_encode($this->entity->approveEntityMembership([
      'clientId' => $this->input->post('clientId'),
      'validationRule' => 'approve-entity-membership'
    ]));
  }

  public function upgradeEntityMembership() {
    $this->custom_session->apiIsLoggedIn()
      ->apiIsAgency();
    
    echo json_encode($this->entity->upgradeEntityMembership([
      'clientId' => $this->input->post('clientId'),
      'validationRule' => 'upgrade-entity-membership'
    ]));
  }

  

  public function requestAccountUpgrade() {
    $this->custom_session->apiIsLoggedIn()
      ->apiIsClient();
    echo json_encode($this->entity->requestAccountUpgrade([
      'userId' => $this->session->userId,
      'clientId' => $this->session->clientId,
      'validationRule' => 'request-account-upgrade'
    ]));
  }

  public function approveEntityUpgrade() {
    $this->custom_session->apiIsLoggedIn()
      ->apiIsAgency();

    echo json_encode($this->entity->approveEntityUpgrade([
      'clientId' => $this->input->post('clientId'),
      'validationRule' => 'approve-upgrade-entity-membership'
    ]));
  }

  public function desapproveEntityUpgrade() {
    $this->custom_session->apiIsLoggedIn()
      ->apiIsAgency();

    echo json_encode($this->entity->desapproveEntityUpgrade([
      'clientId' => $this->input->post('clientId'),
      'validationRule' => 'desappprove-upgrade-entity-membership'
    ]));
  }
}
