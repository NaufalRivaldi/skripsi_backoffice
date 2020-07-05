<?php

// auth
function cekLogin(){
  $CI =& get_instance();
  
  $value = $CI->session->userdata('loggedIn');
  if($value != true){
    flashData('danger', 'Login first!');
    redirect('auth');
  }
}

function cekFinance(){
  $CI =& get_instance();
  if($CI->session->userData('level') != 1){
    flashData('warning', 'You do not have access to this page!');
    redirect('dashboard');
  }
}

function cekLeader(){
  $CI =& get_instance();
  if($CI->session->userData('level') != 2){
    flashData('warning', 'You do not have access to this page!');
    redirect('dashboard');
  }
}

function flashData($type, $value){
  $CI =& get_instance();
  return $CI->session->set_flashData($type, $value);
}

function level($value){
  $text = '';
  switch ($value) {
    case '1':
      $text = "Finance";
      break;
    
    case '2':
      $text = "Leader";
      break;
    
    default:
      $text = "Tenant";
      break;
  }

  return $text;
}

function status($value){
  $text = '';
  switch ($value) {
    case '1':
      $text = '<span class="badge badge-success">Active</span>';
      break;
    
    default:
      $text = '<span class="badge badge-danger">Nonactive</span>';
      break;
  }

  return $text;
}

function setDate($date){
  return date('d-F-Y', strtotime($date));
}

?>