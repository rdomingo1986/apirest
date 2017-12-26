<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Countries extends CI_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->model('Country_model', 'country');
  }

  public function index() { }

	public function listCountries() {
    $this->custom_session->apiIsLoggedIn();

		echo json_encode($this->country->listCountries());
  }
}
