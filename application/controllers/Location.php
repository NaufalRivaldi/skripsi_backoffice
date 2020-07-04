<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('LocationModel', 'location');
    $this->load->library('form_validation');
    
    cekLogin();
    cekFinance();
	}

	public function index(){
    $data['title'] = 'Location';
    $data['no'] = 1;
    $data['location'] = $this->location->showAll();

		$this->load->view('admin/location/index', $data);
  }
    
  public function form($id = null){
    $data['title'] = 'Location';
    
    if(empty($id)){
      $data['location'] = (object)[
        'id' => '',
        'code' => '',
        'name' => ''
      ];
    }else{
      $data['location'] = $this->location->getData($id);
    }

    $this->load->view('admin/location/form', $data);
  }

  public function store(){
    $location = $this->location;
    $validation = $this->form_validation;
    $validation->set_rules($location->rules());
    
    if($validation->run()){
      $location->save();
      flashData('success', 'Save data successfully.');
      redirect('location');
    }
    
    flashData('danger', 'Save data failed!');
    $this->form();
  }

  public function update(){
    $location = $this->location;
    $validation = $this->form_validation;
    $validation->set_rules($location->rules());

    if($validation->run()){
      $location->update();
      flashData('success', 'Update data successfully.');
      redirect('location');
    }

    flashData('danger', 'Update data failed!');
    $this->form($this->input->post('id'));
  }

  public function delete(){
    $this->location->delete();
  }

}
