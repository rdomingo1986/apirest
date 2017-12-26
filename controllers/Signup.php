<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

	public function __construct() {
    parent::__construct();
  }

	public function index($parentAgencyCode = null) {
    $this->custom_session->viewIsLoggedIn(__CLASS__);
    agency_exists($parentAgencyCode);
		$this->load->view('Signup/signup_view', [
      'parentAgencyCode' => $parentAgencyCode
    ]);
	}
}
