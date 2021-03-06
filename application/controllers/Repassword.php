<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Repassword extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('UserModel', 'user');
    $this->load->library('form_validation');
    
    cekLogin();
	}

  public function index(){
    $data['title'] = 'Repassword';
    
    return $this->load->view('admin/repassword/index', $data);
  }

  public function update(){
    $user = $this->user;
    $validation = $this->form_validation;
    $validation->set_rules($user->rulesRePassword());
    if($validation->run()){
      if($user->rePassword()){
        flashData('success', 'Password has been change.');
        redirect('dashboard');
      }else{
        flashData('danger', 'Failed to change password.');
        redirect('dashboard');
      }
    }

    flashData('danger', 'Failed to change password.');
    return $this->index();
  }

  public function updatetenant(){
    $user = $this->user;
    $validation = $this->form_validation;
    $validation->set_rules($user->rulesRePassword());
    if($validation->run()){
      if($user->rePasswordTenant()){
        flashData('success', 'Password has been change.');
        redirect('dashboard');
      }else{
        flashData('danger', 'Failed to change password.');
        redirect('dashboard');
      }
    }

    flashData('danger', 'Failed to change password.');
    return $this->index();
  }

}
