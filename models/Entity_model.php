<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entity_model extends CI_Model {

	public function __construct() {
    parent::__construct();
    $this->load->model('User_model', 'user');
  }

  public function getMainAgenciesList($args) {
    $this->custom_form_validation->validate($args, 'get-main-agency-list');

    $this->db->select('
      entity.id AS agencyId,
      CONCAT(entity.first_name,\' \',entity.last_name) AS fullName,
      entity.person_type AS personType,
      IF(entity.gender IS NULL, \'\', entity.gender) AS gender,
      IF(entity.user_id = '.$args['owner_id'].', \'Propia\', \'Administrada\') AS agencyCondition,
      IF(entity.company_name IS NULL, \'\', entity.company_name) AS companyName,
      IF(entity.rfc IS NULL, \'\', entity.rfc) AS RFC,
      IF(entity.phone_number IS NULL, \'\', entity.phone_number) AS phoneNumber,
      IF(entity.mobile_number IS NULL, \'\', entity.mobile_number) AS mobileNumber,
      user.email AS userEmail
    ')
      ->from('entity')
      ->join('user','user.id=entity.user_id')
      ->where('entity.owner_id', $args['owner_id'])
      ->where('entity.type', 'agencia');
    if($args['keyword'] != null && $args['keyword'] != 'null') {
      $this->db->group_start()
        ->like('entity.first_name', urldecode($args['keyword']))
        ->or_like('entity.last_name', urldecode($args['keyword']))
        ->or_like('entity.full_name', urldecode($args['keyword']))
        ->or_like('entity.phone_number', $args['keyword'])
        ->or_like('entity.mobile_number', urldecode($args['keyword']))
        ->or_like('entity.company_name', urldecode($args['keyword']))
        ->or_like('entity.rfc', urldecode($args['keyword']))
        ->or_like('user.email', urldecode($args['keyword']))
        ->group_end();
    }
    if($args['condition'] != null && $args['condition'] != 'null') {
      if($args['condition'] == 'propia') {
        $this->db->where('entity.user_id', $args['owner_id']);
      } else if($args['condition'] == 'administrada') {
        $this->db->where('entity.user_id !=', $args['owner_id']);
      }
    }
    if($args['personType'] != null && $args['personType'] != 'null') {
      $this->db->where('entity.person_type', $args['personType']);
    }
    return $this->db->limit($args['limit'], $args['offset'])
      ->get()
      ->result();
  }

  public function createMainAgency($args) {
    $this->custom_form_validation->validateGroup($args, [
      'module' => 'entity',
      'action' => 'create'
    ]);

    $ownerId = $userId = $args['owner_id'];

    $agencyCode = random_md5hash([
      'table' => 'entity',
      'column' => 'agency_code'
    ]);

    if($args['agency_condition'] == 'administrada') {
      $passwordTemp = substr(random_md5hash(), 0, 8);

      $userId = $this->user->registerUser([
        'email' => $args['email'],
        'password' => $passwordTemp,
        'role' => 'admin',
        'account_status'=> 'porcambiarclave'
      ]);
    }

    $this->db->insert('entity', [
      'user_id' => $userId,
      'owner_id' => $ownerId,
      'first_name' => strlen($args['first_name']) === 0 ? NULL : $args['first_name'],
      'last_name' => strlen($args['last_name']) === 0 ? NULL : $args['last_name'],
      'full_name' => strlen($args['first_name']) === 0 ? ( strlen($args['last_name']) === 0 ? NULL : $args['last_name'] ) : ( strlen($args['last_name']) === 0 ? $args['first_name'] : $args['first_name'].' '.$args['last_name'] ),
      'gender' => strlen($args['gender']) === 0 ? NULL : $args['gender'],
      'person_type' => $args['person_type'],
      'agency_condition' => $args['agency_condition'],
      'phone_number' => strlen($args['phone_number']) === 0 ? NULL : $args['phone_number'],
      'mobile_number' => strlen($args['mobile_number']) === 0 ? NULL : $args['mobile_number'],
      'company_name' => $args['person_type'] == 'natural' || strlen($args['company_name']) === 0 ? NULL : $args['company_name'],
      'rfc' => $args['person_type'] == 'natural' || strlen($args['rfc']) === 0 ? NULL : $args['rfc'],
      'country_id' => strlen($args['country_id']) === 0 ? NULL : $args['country_id'],
      'state' => strlen($args['state']) === 0 ? NULL : $args['state'],
      'city' => strlen($args['city']) === 0 ? NULL : $args['city'],
      'address' => strlen($args['address']) === 0 ? NULL : $args['address'],
      'zip_code' => strlen($args['zip_code']) === 0 ? NULL : $args['zip_code'],
      'agency_code' => $agencyCode
    ]);

    $entityId = $this->db->insert_id();

    if($args['agency_condition'] == 'administrada') { 
      $this->mailer->setSubject('Se ha creado una agencia administrada')
        ->setBody('
          Hemos creado su cuenta de agencia con éxito en admintool. Sus datos de acceso son <br />
          Usuario: '.$args['email'].'<br />
          Contraseña: '.$passwordTemp.'
        ')
        ->setEmail($args['email'])
        ->sendMail();
    }
    
    return true;
  }

  public function getEntityDataById($args) {
    $this->custom_form_validation->validate($args, 'get-agency-data-by-id');

    return $this->db->select('
      entity.id AS agencyId,
      entity.type AS entityType,
      entity2.id AS parentEntityId,
      entity2.type AS parentEntityType,
      entity2.full_name AS parentFullName,
      entity2.company_name AS parentCompanyName,
      entity2.person_type AS parentPersonType,
      entity3.id AS grandParentEntityId,
      entity3.type AS grandParentEntityType,
      entity3.full_name AS grandParentFullName,
      entity3.company_name AS grandParentCompanyName,
      entity3.person_type AS grandParentPersonType,
      IF(entity.agency_condition IS NULL, \'\', entity.agency_condition) AS agencyCondition,
      IF(entity.first_name IS NULL, \'\', entity.first_name) AS firstName,
      IF(entity.last_name IS NULL, \'\', entity.last_name) AS lastName,
      IF(entity.full_name IS NULL, \'\', entity.full_name) AS fullName,
      IF(entity.gender IS NULL, \'\', entity.gender) AS gender,
      entity.person_type AS personType,
      IF(entity.phone_number IS NULL, \'\', entity.phone_number) AS phoneNumber,
      IF(entity.mobile_number IS NULL, \'\', entity.mobile_number) AS mobileNumber,
      IF(entity.company_name IS NULL, \'\', entity.company_name) AS companyName,
      IF(entity.rfc IS NULL, \'\', entity.rfc) AS RFC,
      IF(entity.country_id IS NULL, \'\', entity.country_id) AS countryId,
      IF(country.short_name IS NULL, \'\', country.short_name) AS countryShortName,
      IF(entity.state IS NULL, \'\', entity.state) AS state,
      IF(entity.city IS NULL, \'\', entity.city) AS city,
      IF(entity.address IS NULL, \'\', entity.address) as address,
      IF(entity.zip_code IS NULL, \'\', entity.zip_code) AS zipCode,
      IF(entity.agency_code IS NULL, \'\', entity.agency_code) AS agencyCode,
      IF(entity.user_id = '.$args['owner_id'].', \'\', user.email) AS userEmail,
      user.id AS userId
    ')
      ->from('entity')
      ->join('user','user.id=entity.user_id', 'left')
      ->join('country','country.id=entity.country_id', 'left')
      ->join('entity AS entity2','entity2.id=entity.parent_id', 'left')
      ->join('entity AS entity3','entity3.id=entity2.parent_id', 'left')
      ->where('entity.id', $args['id'])
      ->get()
      ->row();
  }

  public function getClientsListByAgencyId($args) {
    $this->custom_form_validation->validate($args, 'get-clients-list-by-agency-id');

    $this->db->select('
      entity.id AS clientId,
      IF(entity.type = \'subagencia\', \'Sub-agencia\', \'Cliente\') AS accountType,
      entity.type AS entityType,
      user.email AS userEmail,
      IF(entity.phone_number IS NULL, \'\', entity.phone_number) AS phoneNumber,
      IF(entity.mobile_number IS NULL, \'\', entity.mobile_number) AS mobileNumber,
      IF(entity.person_type = \'natural\', entity.full_name, entity.company_name) AS entityName,
      entity.person_type AS personType
    ')
      ->from('entity')
      ->join('user','user.id=entity.user_id')
      ->where('parent_id', $args['parent_id'])
      ->group_start()
      ->where('type', 'subagencia')
      ->or_where('type', 'cliente')
      ->group_end();
    if($args['keyword'] != null && $args['keyword'] != 'null') {
      $this->db->group_start()
        ->like('entity.first_name', urldecode($args['keyword']))
        ->or_like('entity.last_name', urldecode($args['keyword']))
        ->or_like('entity.full_name', urldecode($args['keyword']))
        ->or_like('entity.phone_number', $args['keyword'])
        ->or_like('entity.mobile_number', urldecode($args['keyword']))
        ->or_like('entity.company_name', urldecode($args['keyword']))
        ->or_like('entity.rfc', urldecode($args['keyword']))
        ->or_like('user.email', urldecode($args['keyword']))
        ->group_end();
    }
    if($args['type'] != null && $args['type'] != 'null') {
      if($args['type'] == 'subagencia') {
        $this->db->where('entity.type', $args['type']);
      } else if($args['type'] == 'cliente') {
        $this->db->where('entity.type', $args['type']);
      }
    }
    if($args['status'] != null && $args['status'] != 'null') {
      if($args['status'] == 'activo' || $args['status'] == 'inactivo') {
        $status = $args['status'] == 'activo' ? 1 : 0;
        $this->db->where('user.is_active', $status);
      } else {
        $this->db->where('user.account_status', $args['status']);
      }
    }
    return $this->db->limit($args['limit'], $args['offset'])
      ->get()
      ->result();
  }

  public function editEntity($args) {
    $args['id'] = $args['agency_id'];
    $this->custom_form_validation->validateGroup($args, [
      'module' => 'entity',
      'action' => 'edit'
    ]);

    $agencyCondition = $this->getAgencyCondition($args['agency_id']);
    $userEmail = $this->getAdministratorEmailByEntityId($args['agency_id']);
    $entityTipe = $this->getAgencyType($args['agency_id']);

    $userId = null;

    $this->db->where('id', $args['agency_id'])
      ->update('entity', [
        'first_name' => strlen($args['first_name']) === 0 ? NULL : $args['first_name'],
        'last_name' => strlen($args['last_name']) === 0 ? NULL : $args['last_name'],
        'full_name' => strlen($args['first_name']) === 0 ? ( strlen($args['last_name']) === 0 ? NULL : $args['last_name'] ) : ( strlen($args['last_name']) === 0 ? $args['first_name'] : $args['first_name'].' '.$args['last_name'] ),
        'gender' => strlen($args['gender']) === 0 ? NULL : $args['gender'],
        'phone_number' => strlen($args['phone_number']) === 0 ? NULL : $args['phone_number'],
        'mobile_number' => strlen($args['mobile_number']) === 0 ? NULL : $args['mobile_number'],
        'company_name' => $args['person_type'] == 'natural' ? NULL : $args['company_name'],
        'rfc' => $args['person_type'] == 'natural' ? NULL : $args['rfc'],
        'person_type' => $args['person_type'],
        'agency_condition' => $args['agency_condition'],
        'country_id' => strlen($args['country_id']) === 0 ? NULL : $args['country_id'],
        'state' => strlen($args['state']) === 0 ? NULL : $args['state'],
        'city' => strlen($args['city']) === 0 ? NULL : $args['city'],
        'address' => strlen($args['address']) === 0 ? NULL : $args['address'],
        'zip_code' => strlen($args['zip_code']) === 0 ? NULL : $args['zip_code']
      ]);
    
    $changeConditionOrUser = false;
    if($agencyCondition == 'propia' && $args['agency_condition'] == 'administrada') {
      $changeConditionOrUser = true;
      $passwordTemp = substr(random_md5hash(), 0, 8);
      
      $userId = $this->user->registerUser([
        'email' => $args['email'],
        'password' => $passwordTemp,
        'role' => 'admin',
        'account_status'=> 'porcambiarclave'
      ]);

      $this->db->where('entity.id', $args['agency_id'])
        ->update('entity', [
          'user_id' => $userId
        ]);

      $this->mailer->setSubject('Se ha cambiado el administrador de la agencia')
        ->setBody('
          Hemos asignado su correo como administrador de una agencia en admintool. Sus datos de acceso son <br />
          Usuario: '.$args['email'].'<br />
          Contraseña: '.$passwordTemp.'
        ')
        ->setEmail($args['email'])
        ->sendMail();
    } else if($agencyCondition == 'administrada' && $args['agency_condition'] == 'propia') {
      $changeConditionOrUser = true;
      $this->db->where('entity.id', $args['agency_id'])
        ->update('entity', [
          'user_id' => $args['owner_id']
        ]);

      $this->db->where('user.email', $userEmail)
        ->delete('user');

      $this->mailer->setSubject('Se ha eliminado administrador de la agencia')
        ->setBody('
          Su usario ha sido deshabilitado como administrador de una agencia en admintool
        ')
        ->setEmail($userEmail)
        ->sendMail();
    } else if(($agencyCondition == null && $userEmail != $args['email']) || ($agencyCondition == 'administrada' && $args['agency_condition'] == 'administrada' && $userEmail != $args['email'])) {
      $changeConditionOrUser = true;
      $passwordTemp = substr(random_md5hash(), 0, 8);
      
      $userId = $this->user->registerUser([
        'email' => $args['email'],
        'password' => $passwordTemp,
        'role' => $entityTipe != 'agencia' ? $entityTipe : 'admin',
        'account_status'=> 'porcambiarclave'
      ]);

      if($agencyCondition == null) {
        $this->db->set('owner_id', $userId, false);
      }

      $this->db->where('entity.id', $args['agency_id'])
        ->update('entity', [
          'user_id' => $userId
        ]);

      $this->db->where('user.email', $userEmail)
        ->delete('user');

      $this->mailer->setSubject('Se ha eliminado administrador de la agencia')
        ->setBody('
          Su usario ha sido desabilidato como administrador de una agencia en admintool
        ')
        ->setEmail($userEmail)
        ->sendMail();

      $this->mailer->setSubject('Se ha cambiado el administrador de la agencia')
        ->setBody('
          Hemos asignado su correo como administrador de una agencia en admintool. Sus datos de acceso son <br />
          Usuario: '.$args['email'].'<br />
          Contraseña: '.$passwordTemp.'
        ')
        ->setEmail($args['email'])
        ->sendMail();
    }
    return $changeConditionOrUser ? (int) $userId : (int) $args['userId'];
  }

  public function registerClient($args) {
    $args['agency_condition'] = 'administrada';
    $this->custom_form_validation->validateGroup($args, [
      'module' => 'entity',
      'action' => 'createsubentity'
    ]);

    if(array_key_exists('parentAgencyCode', $args)) {
      agency_exists($args['parentAgencyCode']);
    }
    $parentId = array_key_exists('parent_id', $args) ? $args['parent_id'] : $this->getAgencyIdByAgencyCode($args['parentAgencyCode']);
    $userId = $this->user->registerUser($args);
    $entityTipe = $this->getAgencyType($args['parent_id']);
    if($entityType == 'subagencia') {
      $args['role'] = 'cliente';
    }
    if($args['role'] === 'subagencia') {
      $agencyCode = random_md5hash([
        'table' => 'entity',
        'column' => 'agency_code'
      ]);
      $this->db->set('agency_code', $agencyCode);
    }
    $this->db->insert('entity', [
      'parent_id' => $parentId,
      'user_id' => $userId,
      'first_name' => strlen($args['first_name']) === 0 ? NULL : $args['first_name'],
      'last_name' => strlen($args['last_name']) === 0 ? NULL : $args['last_name'],
      'full_name' => strlen($args['first_name']) === 0 ? ( strlen($args['last_name']) === 0 ? NULL : $args['last_name'] ) : ( strlen($args['last_name']) === 0 ? $args['first_name'] : $args['first_name'].' '.$args['last_name'] ),
      'gender' => strlen($args['gender']) === 0 ? NULL : $args['gender'],
      'person_type' => $args['person_type'],
      'type' => $args['role'],
      'phone_number' => strlen($args['phone_number']) === 0 ? NULL : $args['phone_number'],
      'mobile_number' => strlen($args['mobile_number']) === 0 ? NULL : $args['mobile_number'],
      'company_name' => strlen($args['company_name']) === 0 ? NULL : $args['company_name'],
      'rfc' => strlen($args['rfc']) === 0 ? NULL : $args['rfc'],
      'country_id' => strlen($args['country_id']) === 0 ? NULL : $args['country_id'],
      'state' => strlen($args['state']) === 0 ? NULL : $args['state'],
      'city' => strlen($args['city']) === 0 ? NULL : $args['city'],
      'address' => strlen($args['address']) === 0 ? NULL : $args['address'],
      'zip_code' => strlen($args['zip_code']) === 0 ? NULL : $args['zip_code'],
    ]);
    $userId = $this->db->insert_id();
    if($args['account_status'] == 'porcambiarclave') {
      if($args['role'] == 'subagencia') {
        $this->mailer->setSubject('Formato correo para cuando por el crm se registra una subagencia')
          ->setBody('Su clave de acceso es ' . $args['password'] . ' y su codigo de agencia es ' . $agencyCode)
          ->setEmail($args['email'])
          ->sendMail();
      } else if ($args['role'] == 'cliente') {
        $this->mailer->setSubject('Formato correo para cuando por el crm se registra un cliente')
          ->setBody('Su clave de acceso es ' . $args['password'])
          ->setEmail($args['email'])
          ->sendMail();
      }
    } else if ($args['account_status'] == 'autoregistro') {
      $this->mailer->setSubject('Formato correo para cuando se autoregistra un cliente')
        ->setBody('Se ha registrado con éxito al sistema, su cuenta debe ser revisada y aprobada')
        ->setEmail($args['email'])
        ->sendMail();
    }
    
    return true;
  }

  private function getAgencyCondition($entityId) {
    return $this->db->select('entity.agency_condition')
      ->from('entity')
      ->where('entity.id', $entityId)
      ->get()
      ->row()
      ->agency_condition;
  }

  private function getAgencyType($entityId) {
    return $this->db->select('entity.type')
      ->from('entity')
      ->where('entity.id', $entityId)
      ->get()
      ->row()
      ->type;
  }

  private function getAdministratorIdByEntityId($entityId) {
    return $this->db->select('entity.user_id')
      ->from('entity')
      ->where('entity.id', $entityId)
      ->get()
      ->row()
      ->user_id;
  }

  private function getAdministratorEmailByEntityId($entityId) {
    return $this->db->select('user.email')
      ->from('user')
      ->join('entity', 'entity.user_id=user.id', 'left')
      ->where('entity.id', $entityId)
      ->get()
      ->row()
      ->email;
  }

  public function getAgenciesChainByAgencyId($args) {
    // $this->custom_form_validation->validate($args, 'get-agencies-chain-by-user-role');

    $userRole = $this->user->getUserRoleByEntityId($args['agencyId']);
    if($userRole == 'superadmin') {
      $userId = $this->user->getUserIdByEntityId($args['agencyId']);

      $agenciesChain = $result = $this->db->select('
        entity.id AS entityId,
        IF(entity.person_type = \'natural\', entity.full_name, entity.company_name) AS entityName,
        agency_condition AS agencyCondition
      ')
        ->from('entity')
        ->where('owner_id', $userId)
        ->get()
        ->result_array();
      
      $pos = 1;
      foreach($result AS $key => $register) {
        if($register['agencyCondition'] == 'propia') {
          $subResult = $this->getAgenciesByParentId($register['entityId']);
          if($subResult != null) {
            array_splice($agenciesChain, $key + $pos, 0, $subResult);
            $pos += count($subResult);
          }
        }
      }
      
      return $agenciesChain;
      
    } else if($userRole == 'admin') {
      return $this->db->select('
        entity.id AS entityId,
        IF(entity.person_type = \'natural\', entity.full_name, entity.company_name) AS entityName,
        agency_condition AS agencyCondition
      ')
        ->from('entity')
        ->where('entity.parent_id', $args['agencyId'])
        ->where('entity.type', 'subagencia')
        ->get()
        ->result();
    } else {
      return 'NA';
    }
  }

  public function getBreadCrumbInfo($entityId) {
    // validar

    return $this->db->select('
      IF(entity.person_type = \'natural\', entity.full_name, entity.company_name) AS breadcrumb,
      IF(entity2.person_type = \'natural\', entity2.full_name, entity2.company_name) AS parentBreadcrumb,
      entity2.id AS parentId
    ')
    ->from('entity')
    ->join('entity AS entity2','entity.parent_id=entity2.id', 'left')
    ->where('entity.id', $entityId)
    ->get()
    ->row();
  }

  public function getAgenciesByParentId($parentId) {
    return $this->db->select('
      entity.id AS entityId,
      IF(entity.person_type = \'natural\', CONCAT(\'- - - \', entity.full_name), CONCAT(\'- - - \', entity.company_name)) AS entityName,
      agency_condition AS agencyCondition
    ')
      ->from('entity')
      ->where([
        'parent_id'=> $parentId,
        'type' => 'subagencia'
      ])
      ->get()
      ->result_array();
  }

  public function deleteEntityById($entityId, $agencyId) {
    // validar
    $entityType = $this->getAgencyType($entityId);
    if($this->getAgencyCondition($entityId) == 'propia') {
      $this->db->where('id', $entityId)
        ->delete('entity');
    } else {
      $this->db->where('id', $this->user->getUserIdByEntityId($entityId))
        ->delete('user');
    }

    $this->db->query('
      DELETE FROM user 
      WHERE user.id NOT IN (SELECT user_id FROM entity) 
      AND user.role != \'superadmin\'
    ');

    $this->db->query('
      DELETE FROM item
      WHERE item.id NOT IN (SELECT item_id FROM item_entity)
    ');

    if($entityType == 'agencia') {
      return $this->getMainAgenciesList([
        'limit' => 12,
        'offset' => 0,
        'keyword' => 'null',
        'condition' => 'null',
        'personType' => 'null',
        'owner_id' => $this->session->userId
      ]);
    } else {
      return $this->getClientsListByAgencyId([
        'limit' => 12,
        'offset' => 0,
        'keyword' => 'null',
        'type' => 'null',
        'status' => 'null',
        'parent_id' => $agencyId
      ]);
    }
  }

	

  public function activateEntity($args) {
    $this->custom_form_validation->validate($args, $args['validationRule']);

    $userId = $this->user->getUserIdByEntityId($args['clientId']);
    return $this->db->where('id', $userId)
      ->update('user', [
        'is_active' => 1
      ]);
  }

  public function inactivateEntity($args) {
    $this->custom_form_validation->validate($args, $args['validationRule']);

    $userId = $this->user->getUserIdByEntityId($args['clientId']);
    return $this->db->where('id', $userId)
      ->update('user', [
        'is_active' => 0
      ]);
  }

  public function approveEntityMembership($args) {
    $this->custom_form_validation->validate($args, $args['validationRule']);

    $userId = $this->user->getUserIdByEntityId($args['clientId']);
    $this->db->where('id', $userId)
      ->update('user', [
        'account_status' => 'normal'
      ]);
    
    $userEmail = $this->user->getEmailById($userId);
    $this->mailer->setSubject('Formato correo para cuando por el crm se aprueba un cliente')
      ->setBody('Se ha aprobado su cuenta')
      ->setEmail($userEmail)
      ->sendMail();
    return true;
  }

  public function upgradeEntityMembership($args) {
    $this->custom_form_validation->validate($args, $args['validationRule']);

    $agencyCode = random_md5hash([
      'table' => 'client',
      'column' => 'agency_code'
    ]);
    
    $this->setAgencyCode($args['clientId'], $agencyCode);
    
    $this->user->changeUserRole($args['clientId'], 'agencia');

    $userEmail = $this->user->getEmailById(
      $this->user->getUserIdByEntityId($args['clientId'])
    );

    $this->mailer->setSubject('Formato correo para cuando por el crm se cambia de cliente a agencia')
      ->setBody('Su cuenta se a actualizado a cuenta de agencia')
      ->setEmail($userEmail)
      ->sendMail();
    return true;
  }

  public function setAgencyCode($clientId, $agencyCode) {
    return $this->db->where('id', $clientId)
      ->update('client', [
        'agency_code' => $agencyCode
      ]);
  }

  

  public function requestAccountUpgrade($args) {
    $this->custom_form_validation->validate($args, $args['validationRule']);

    $this->user->changeAccountStatus($args['userId'], 'poractualizar');

    $userEmail = $this->user->getEmailById(
      $this->user->getUserIdByEntityId(
        $this->getParentIdByEntityId($args['clientId'])
      )
    );
    $this->mailer->setSubject('Formato correo para cuando el cliente solicita upgrade de la cuenta')
      ->setBody('El cliente ' . $args['clientId'] . ' ha solicitado upgrade de cuenta')
      ->setEmail($userEmail)
      ->sendMail();
        
    return true;
  }

  public function approveEntityUpgrade($args) {
    $this->custom_form_validation->validate($args, $args['validationRule']);

    $agencyCode = random_md5hash([
      'table' => 'client',
      'column' => 'agency_code'
    ]);
    
    $this->setAgencyCode($args['clientId'], $agencyCode);
    $this->user->changeUserRole($args['clientId'], 'agencia');
    $this->user->changeAccountStatus($args['clientId'], 'normal');

    $userEmail = $this->user->getEmailById(
      $this->user->getUserIdByEntityId($args['clientId'])
    );

    $this->mailer->setSubject('Formato correo para cuando por el crm se aprueba cambio de cliente a agencia')
      ->setBody('Su solicitud ha sido aprobada y su cuenta se a actualizado a cuenta de agencia')
      ->setEmail($userEmail)
      ->sendMail();
    return true;
  }

  public function desapproveEntityUpgrade($args) {
    $this->custom_form_validation->validate($args, $args['validationRule']);
  }

  public function getParentIdByEntityId($entityId) {
    return $this->db->select('parent_id')
      ->from('entity')
      ->where('id', $entityId)
      ->get()
      ->row()
      ->parent_id;
  }
  
  public function getAgencyIdByAgencyCode($agencyCode) {
    $res = $this->db->select('id')
      ->from('client')
      ->where('agency_code', $agencyCode)
      ->get();
    if($res->num_rows() != 1) {
      throw new Exception('Valor inesperado en ' . __CLASS__ . ' ' . __FUNCTION__);
    }
    return $res->row()->id;
  }
}
