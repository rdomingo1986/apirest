<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom_form_validation {
  protected $CI;

	public function __construct() {
    $this->CI =& get_instance();
  }

  public function validate($data, $stringConfig = '', $rules = '') {
    $this->CI->form_validation->set_data($data);
    if($stringConfig == '') {
      $this->CI->form_validation->set_rules($rules);
    }
    $result = $this->CI->form_validation->run($stringConfig);
    if($result === false) {
      throw new Exception(implode(',',$this->CI->form_validation->error_array()));
      exit;
    }
    return $this;
  }

  public function oneOfTwo($valueOne, $valueTwo) {
    if(strlen($valueOne) === 0 && strlen($valueTwo) === 0) {
      throw new Exception('Uno de ambos valores es obligatorio');
      exit;
    }
    return $this;
  }

  public function validateGroup($args, $reference) {
    if($reference['module'] == 'entity') {
      if($reference['action'] == 'create') {
        $ownPerson = 'create-main-agency-own-person';
        $ownCompany = 'create-main-agency-own-company';
        $administeredPerson = 'create-main-agency-administered-person';
        $administeredCompany = 'create-main-agency-administered-company';
      } else if($reference['action'] == 'edit') {
        $ownPerson = 'edit-main-agency-own-person';
        $ownCompany = 'edit-main-agency-own-company';
        $administeredPerson = 'edit-main-agency-administered-person';
        $administeredCompany = 'edit-main-agency-administered-company';
      } else if($reference['action'] == 'createsubentity') {
        $administeredPerson = 'register-entity-person';
        $administeredCompany = 'register-entity-company';
      }

      if($args['agency_condition'] == 'propia') {
        if($args['person_type'] == 'natural') {
          $this->validate($args, $ownPerson)
            ->oneOfTwo($args['phone_number'], $args['mobile_number']);
        } else if($args['person_type'] == 'juridica') {
          $this->validate($args, $ownCompany)
            ->oneOfTwo($args['phone_number'], $args['mobile_number']);
          
          $validationData = [
            'table' => 'entity',
            'column' => 'company_name',
            'value' => $args['company_name'],
          ];
          if($reference['action'] == 'edit') {
            $validationData['id'] = $args['id'];
          }
          is_uniquevalue($validationData);
          unset($validationData);

          $validationData = [
            'table' => 'entity',
            'column' => 'rfc',
            'value' => $args['rfc']
          ];
          if($reference['action'] == 'edit') {
            $validationData['id'] = $args['id'];
          }
          is_uniquevalue($validationData);
        } else {
          throw new Exception('Valores inesperados para person_type - propia');
          exit;
        }
      } else if($args['agency_condition'] == 'administrada') {
        if($args['person_type'] == 'natural') {
          $this->validate($args, $administeredPerson)
            ->oneOfTwo($args['phone_number'], $args['mobile_number']);
        } else if($args['person_type'] == 'juridica') {
          $this->validate($args, $administeredCompany)
            ->oneOfTwo($args['phone_number'], $args['mobile_number']);
  
            $validationData = [
              'table' => 'entity',
              'column' => 'company_name',
              'value' => $args['company_name'],
            ];
            if($reference['action'] == 'edit') {
              $validationData['id'] = $args['id'];
            }
            is_uniquevalue($validationData);
            unset($validationData);
  
            $validationData = [
              'table' => 'entity',
              'column' => 'rfc',
              'value' => $args['rfc']
            ];
            if($reference['action'] == 'edit') {
              $validationData['id'] = $args['id'];
            }
            is_uniquevalue($validationData);
        } else {
          throw new Exception('Valores inesperados para person_type - administrada ');
          exit;
        }
        $validationData = [
          'table' => 'user',
          'column' => 'email',
          'value' => $args['email']
        ];
        if($reference['action'] == 'edit') {
          $this->CI->load->model('User_model', 'user');
          $validationData['id'] = $this->CI->user->getUserIdByEntityId($args['agency_id']);
        }
        is_uniquevalue($validationData);
      } else if($args['agency_condition'] != null){
        throw new Exception('Valores inesperados para agency_condition');
        exit;
      }
    }
    return $this;
  }
}