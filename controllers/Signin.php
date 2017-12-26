<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends CI_Controller {

	public function __construct() {
    parent::__construct();
  }

	public function index() {
		$this->custom_session->viewIsLoggedIn(__CLASS__);
		$this->load->view('Signin/signin_view');
	}
}
