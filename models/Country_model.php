<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country_model extends CI_Model {

	public function __construct() {
    parent::__construct();
  }

  public function listCountries() {
    return $this->db->select('
      country.id AS countryId,
      country.short_name AS countryShortName
    ')
      ->from('country')
      ->get()
      ->result();
  }
}
