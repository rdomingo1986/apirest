<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('random_md5hash')) {
  function random_md5hash($args = []) {
    if(!array_key_exists('table', $args) && !array_key_exists('column', $args)) {
      return md5(md5(time() . time() . time()));
      exit;
    }
    $CI =& get_instance();
    do {
      $md5Hash = md5(time() . time() . time());
      $res = $CI->db->select('id')
        ->from($args['table'])
        ->where($args['column'], $md5Hash)
        ->get()
        ->num_rows();
    }while($res != 0);
    return $md5Hash;
  }
}

if(!function_exists('agency_exists')) {
  function agency_exists($agencyCode) {
    if($agencyCode == null) {
      throw new Exception('Código de agencia no especificado');
    }
    $CI =& get_instance();
    $res = $CI->db->select('id')
      ->from('client')
      ->where('agency_code', $agencyCode)
      ->get()
      ->num_rows();
    if($res > 1) {
      throw new Exception('Existe más de una agencia con el mismo codigo');
    } else if($res == 0) {
      throw new Exception('Código de agencia no existe');
    }
    return true;
  }
}

if(!function_exists('passwordreset_valid')) {
  function passwordreset_valid($passwordResetCode, $interval = '600') {
    if($passwordResetCode == null) {
      throw new Exception('Código de reinicio de contraseña no especificado');
    }
    $CI =& get_instance();
    $res = $CI->db->select('id')
      ->from('user')
      ->where('passreset_code', $passwordResetCode)
      ->where('(last_req_passreset + INTERVAL ' . $interval . ' SECOND) >', date('Y-m-d H:i:s', time()))
      ->get()
      ->num_rows();
    if($res == 0) {
      throw new Exception('Código de reinicio de contraseña no existe o está vencido');
    }
    return true;
  }
}

if(!function_exists('is_uniquevalue')) {
  function is_uniquevalue($args) {
    $CI =& get_instance();

    $CI->db->select('id')
      ->from($args['table'])
      ->where($args['column'], $args['value']);

    if(array_key_exists('owner_id', $args) && $args['owner_id'] != false) {
      $CI->db->where($args['column_owner'], $args['owner_id']);
    }

    if(array_key_exists('id', $args) && $args['id'] != false) {
      $CI->db->where('id !=', $args['id']);
    }

    $res = $CI->db->get()
      ->num_rows();
    
    if($res != 0) {
      if(array_key_exists('ajax-validation', $args) && $args['ajax-validation']) {
        return array_key_exists('invert', $args) && $args['invert'] ? true : false;
      }
      throw new Exception('El campo '.$args['column'].' con el valor '.$args['value'].' ya se encuentra registrado');
    }
    return array_key_exists('invert', $args) && $args['invert'] ? false : true;
  }
}