<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct() {
    parent::__construct();
  }

  public function signIn($args) {
    $this->custom_form_validation->validate($args, 'sign-in');
    
    $row = $this->db->select('
      user.id AS userId,
      user.role AS userRole,
      user.email AS userEmail,
      user.account_status AS accountStatus,
      user.is_active AS isActive,
      entity.id AS clientId,
      entity.parent_id AS parentId,
      IF(entity.company_name IS NULL, CONCAT(entity.first_name, \' \', entity.last_name), entity.company_name) AS fullName
    ')
      ->from('user')
      ->join('entity','entity.user_id=user.id','left')
      ->where([
        'user.email' => $args['email'],
        'user.password' => md5($args['password'])
      ])
      ->get()
      ->result();
      if($row == null) {
        return null;
      }else {
        $row = $row[0];
        if($row->isActive == 0) {
          return [
            'type' => 'info',
            'msg' => 'El usuario se encuentra inactivo. Comuniquese con el administrador del sistema'
          ];
        } else if($row->accountStatus == 'autoregistro') {
          return [
            'type' => 'info',
            'msg' => 'El usuario no ha sido aprobado por el admin'
          ];
        } else if($row->accountStatus == 'porcambiarclave') {
          $this->trackSignIn($this->setUserSessionData($row));
          return [
            'type' => 'warning',
            'msg' => 'El usuario debe cambiar clave'
          ];
        } else {
          $this->trackSignIn($this->setUserSessionData($row));
          return [
            'type' => 'success',
            'accion' => true,
            'msg' => 'OK'
          ];
        }
      }
  }

  private function setUserSessionData($row) {
    $userData['userId'] = $row->userId;
    $userData['userRole'] = $row->userRole;
    $userData['userEmail'] = $row->userEmail;
    $userData['clientId'] = $row->clientId;
    $userData['parentId'] = $row->parentId;
    $userData['fullName'] = $row->fullName;
    $userData['accountStatus'] = $row->accountStatus;
    $this->session->set_userdata($userData);
    return $userData['userId'];
  }

  private function trackSignIn($userId) {
    return $this->db->where('id', $userId)
      ->update('user', [
        'last_login' => date('Y-m-d H:i:s', time()),
        'last_ip' => $_SERVER['REMOTE_ADDR']
      ]);
  }

  public function registerUser($args) {
    //validar cuando sea requerido
    $this->db->insert('user', [
      'email' => $args['email'],
      'password' => md5($args['password']),
      'role' => $args['role'],
      'created_at' => date('Y-m-d H:i:s', time()),
      'account_status' => $args['account_status']
    ]);
		return $this->db->insert_id();
  }

  public function forgotPassword($args) {
    $this->custom_form_validation->validate($args, $args['validationRule'], [
      'is_unique' => [
        [
          'table' => 'user',
          'column' => 'email',
          'value' => $args['email'],
          'module' => 'forgotpassword'
        ]
      ]
    ]);
    $passresetCode = random_md5hash([
      'table' => 'user',
      'column' => 'passreset_code'
    ]);
    if($this->userIsActive($args['email']) == 0) {
      return [
        'type' => 'info',
        'msg' => 'El usuario se encuentra inactivo. Comuniquese con el administrador del sistema'
      ];
    }
    $this->db->where('email', $args['email'])
      ->update('user', [
        'passreset_code' => $passresetCode,
        'last_req_passreset' => date('Y-m-d H:i:s', time())
      ]);
    $this->mailer->setSubject('Formato correo para forgot password')
      ->setBody('Visite este link para restablecer su contraseña ' . base_url('Recoverypassword/' . $passresetCode))
      ->setEmail($args['email'])
      ->sendMail();
    return true;
  }

  private function userIsActive($userEmail) {
    return $this->db->select('id')
      ->from('user')
      ->where('email', $userEmail)
      ->where('is_active', 1)
      ->get()
      ->num_rows();
  }

  public function recoveryPassword($args) {
    $this->custom_form_validation->validate($args, $args['validationRule']);
    passwordreset_valid($args['resetPasswordCode'], '800');
    $this->db->where('passreset_code', $args['resetPasswordCode'])
      ->update('user', [
        'password' => md5($args['password']),
        'passreset_code' => NULL,
        'last_req_passreset' => NULL
      ]);
    return true;
  }

  public function validOldPassword($args) {
    $this->custom_form_validation->validate($args, $args['validationRule']);
    return $this->isCurrentPassword([
      'userId' => $args['userId'],
      'oldPassword' => $args['oldPassword']
    ], true);
  }

  public function resetPasswordUserByUserId($args) {
    // $this->custom_form_validation->validate($args, 'reset-password-entity-by-user-id');

    $userId = $this->user->getUserIdByEntityId($args['clientId']);
    $userEmail = $this->user->getEmailById($userId);
    $this->db->where('id', $userId)
      ->update('user', [
        'password' => md5($args['password']),
        'account_status' => 'porcambiarclave'
      ]);
    $this->mailer->setSubject('Formato correo para cuando por el crm se reinicia la clave de un cliente')
      ->setBody('Su nueva clave de acceso es ' . $args['password'])
      ->setEmail($userEmail)
      ->sendMail();
    return true;
  }

  private function isCurrentPassword($userData, $isAjax = false) {
    $res = $this->db->select('id')
      ->from('user')
      ->where([
        'id' => $userData['userId'],
        'password' => md5($userData['oldPassword'])
      ])
      ->get()
      ->num_rows();
    
    if($isAjax) {
      return $res == 1 ? true : false;
    } else {
      if($res != 1) {
        throw new Exception('La contraseña anterior no es correcta');
      }
      return true;
    }
  }

  public function resetPassword($args) {
    $this->custom_form_validation->validate($args, $args['validationRule']);
    $this->isCurrentPassword([
      'userId' => $args['userId'],
      'oldPassword' => $args['oldPassword']
    ]);
    $this->db->where('id', $args['userId'])
      ->update('user', [
        'password' => md5($args['newPassword']),
        'account_status' => 'normal'
      ]);
    $this->session->set_userdata('accountStatus', 'normal');
    return true;
  }

  public function getUserIdByEntityId($clientId) {
    //validar
    return $this->db->select('user.id AS userId')
      ->from('user')
      ->join('entity','entity.user_id=user.id')
      ->where('entity.id', $clientId)
      ->get()
      ->row()
      ->userId;
  }

  public function getUserRoleByEntityId($clientId) {
    //validar
    return $this->db->select('user.role AS userRole')
      ->from('user')
      ->join('entity','entity.user_id=user.id')
      ->where('entity.id', $clientId)
      ->get()
      ->row()
      ->userRole;
  }

  public function getEmailById($userId) {
    //validar
    return $this->db->select('user.email AS userEmail')
      ->from('user')
      ->where('id', $userId)
      ->get()
      ->row()
      ->userEmail;
  }

  public function changeUserRole($clientId, $role) {
    return $this->db->where('id', $this->getUserIdByEntityId($clientId))
      ->update('user', [
        'role' => $role
      ]);
  }

  public function changeAccountStatus($userId, $status) {
    return $this->db->where('id', $userId)
      ->update('user', [
        'account_status' => $status
      ]);
  }
}
