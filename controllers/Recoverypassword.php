<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recoverypassword extends CI_Controller {

	public function __construct() {
    parent::__construct();
  }

	public function index($passwordResetCode = null) {
    $this->custom_session->viewIsLoggedIn(__CLASS__);
    passwordreset_valid($passwordResetCode);
		$this->load->view('Recoverypassword/recoverypassword_view', [
      'passwordResetCode' => $passwordResetCode
    ]);
	}
}
