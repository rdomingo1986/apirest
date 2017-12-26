<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->model('User_model', 'user');
  }

  public function index() {
    echo base_url();
  }

  public function signIn() {
		echo json_encode($this->user->signIn([
      'email' => trim($this->input->post('email')),
      'password' => $this->input->post('password')
    ]));
  }

  public function emailIsUnique() {
    $this->custom_form_validation->validate($this->input->post(), 'email-is-unique');

    echo json_encode(is_uniquevalue([
      'table' => 'user',
      'column' => 'email',
      'id' => $this->input->post('id') != null ? $this->input->post('id') : false,
      'value' => $this->input->post('email'),
      'ajax-validation' => true
    ]));
  }

  public function forgotPassword() {
    echo json_encode($this->user->forgotPassword([
      'email' => trim($this->input->post('email')),
      'validationRule' => 'forgot-password'
    ]));
  }

  public function recoveryPassword() {
    echo json_encode($this->user->recoveryPassword([
      'password' => $this->input->post('password'),
      'passwordRepeat' => $this->input->post('passwordRepeat'),
      'resetPasswordCode' => $this->input->post('resetPasswordCode'),
      'validationRule' => 'recovery-password'
    ]));
  }

  public function validOldPassword() {
    $this->custom_session->apiIsLoggedIn();
    echo json_encode($this->user->validOldPassword([
      'oldPassword' => $this->input->post('oldPassword'),
      'userId' => $this->session->userId,
      'validationRule' => 'ajax-validate-old-password'
    ]));
  }

  public function resetPasswordUserByUserId() {
    $this->custom_session->apiIsLoggedIn()
      ->apiNeedsRoles([
        'superadmin',
        'admin',
        'subagencia'
      ]);

    echo json_encode($this->user->resetPasswordUserByUserId([
      'clientId' => $this->input->post('clientId'),
      'password' => $this->input->post('password')
    ]));
  }

  public function resetPassword() {
    $this->custom_session->apiIsLoggedIn();
    echo json_encode($this->user->resetPassword([
      'oldPassword' => $this->input->post('oldPassword'),
      'newPassword' => $this->input->post('newPassword'),
      'newPasswordRepeat' => $this->input->post('newPasswordRepeat'),
      'validationRule' => 'reset-password',
      'userId' => $this->session->userId
    ]));
  }

  public function logOut() {
    $this->session->sess_destroy();
    redirect(base_url(), 'refresh'); 
  }
}
