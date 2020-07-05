<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('UserModel', 'user');
    $this->load->library('form_validation');
    
    cekLogin();
    cekLeader();
	}

	public function index(){
    $data['title'] = 'User';
    $data['no'] = 1;
    $data['user'] = $this->user->showAll();
    if($_GET){
      $data['filter'] = (object)[
        'level' => $_GET['level'],
        'status' => $_GET['status']
      ];
    }else{
      $data['filter'] = (object)[
        'level' => '',
        'status' => ''
      ];
    }

		$this->load->view('admin/user/index', $data);
  }
    
  public function form($id = null){
    $data['title'] = 'User';
    
    if(empty($id)){
      $data['user'] = (object)[
        'id' => '',
        'name' => '',
        'username' => '',
        'level' => ''
      ];
    }else{
      $data['user'] = $this->user->getData($id);
    }

    $this->load->view('admin/user/form', $data);
  }

  public function store(){
    $user = $this->user;
    $validation = $this->form_validation;
    $validation->set_rules($user->rules());
    
    if($validation->run()){
      $user->save();
      flashData('success', 'Save data successfully.');
      redirect('user');
    }
    
    flashData('danger', 'Save data failed!');
    $this->form();
  }

  public function update(){
    $user = $this->user;
    $validation = $this->form_validation;
    $validation->set_rules($user->rules());

    if($validation->run()){
      $user->update();
      flashData('success', 'Update data successfully.');
      redirect('user');
    }

    flashData('danger', 'Update data failed!');
    $this->form($this->input->post('id'));
  }

  public function delete(){
    $this->user->delete();
  }

  public function reset(){
    $this->user->resetPassword();
  }

}
