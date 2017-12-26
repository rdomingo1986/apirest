<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom_session {
  protected $CI;

	public function __construct() {
    $this->CI =& get_instance();
  }

  public function apiIsLoggedIn() {
    if($this->CI->session->userId === null) {
      throw new Exception('No ha iniciado sesión');
    }
    return $this;
  }

  public function apiNeedsRoles($array) {
    if(!in_array($this->CI->session->userRole, $array)) {
      throw new Exception('No posee el rol necesario');
    }
    return $this;
  }

  public function apiIsSuperAdmin() {
    if($this->CI->session->userRole != 'superadmin') {
      throw new Exception('El usuario no es de tipo superadmin');
    }
    return $this;
  }

  public function apiIsAgency() {
    if($this->CI->session->userRole != 'admin') {
      throw new Exception('El usuario no es de tipo agencia');
    }
    return $this;
  }

  public function apiIsSubAgency() {
    if($this->CI->session->userRole != 'subagencia') {
      throw new Exception('El usuario no es de tipo subagencia');
    }
    return $this;
  }

  public function apiIsClient() {
    if($this->CI->session->userRole != 'cliente') {
      throw new Exception('El usuario no es de tipo cliente');
    }
    return $this;
  }

  public function viewIsLoggedIn($class) {
    if($this->CI->session->userId === null) {
      if($class == 'Dashboard') {
        redirect(base_url());
      }
    } else {
      if($class == 'Signin' || $class == 'Signup' || $class == 'Forgotpassword' || $class == 'Recoverypassword') {
        redirect(base_url('Dashboard'));
      } else if($class == 'Resetpassword') {
        if($this->CI->session->accountStatus != 'porcambiarclave') {
          redirect(base_url('Dashboard'));
        }
      }
    }
  }
}