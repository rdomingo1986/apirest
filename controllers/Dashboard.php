<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  public function __construct() {
    parent::__construct();
  }
  
  public function index() {
    $this->custom_session->viewIsLoggedIn(__CLASS__);
    if($this->session->accountStatus == 'porcambiarclave') {
      redirect(base_url('Resetpassword'));
      exit;
    }
		$this->load->view('Dashboard/dashboard_view', [
      'userEmail' => $this->session->userEmail,
      'userRole' => $this->session->userRole
    ]);
	}
}
