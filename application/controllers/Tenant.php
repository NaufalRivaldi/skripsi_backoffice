<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tenant extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('TenantModel', 'tenant');
    $this->load->model('LocationModel', 'location');
    $this->load->model('InvoiceModel', 'invoice');
    $this->load->library('form_validation');
    
    cekLogin();
    cekFinance();
	}

	public function index(){
    $data['title'] = 'Tenant';
    $data['no'] = 1;
    $data['tenant'] = $this->tenant->showAll();
    if($_GET){
      $data['filter'] = (object)[
        'status' => $_GET['status']
      ];
    }else{
      $data['filter'] = (object)[
        'status' => ''
      ];
    }

		$this->load->view('admin/tenant/index', $data);
  }

  public function view($id){
    $data['title'] = 'Tenant';
    $data['tenant'] = $this->tenant->getData($id);
    $data['invoice'] = $this->invoice->showTenantInvoice($id);
    $data['cekPembayaran'] = $this->invoice->cekPembayaran($id);
    $data['no'] = 1;

    $this->load->view('admin/tenant/view', $data);
  }

  public function viewInvoice($id){
    $data['title'] = 'Tenant';
    $data['invoice'] = $this->invoice->getData($id);

    $this->load->view('admin/tenant/view_invoice', $data);
  }
    
  public function form($id = null){
    $data['title'] = 'Tenant';
    $data['location'] = $this->location->showAll();
    
    if(empty($id)){
      $data['tenant'] = (object)[
        'id' => '',
        'code' => '',
        'name' => '',
        'pic' => '',
        'phone' => '',
        'status' => '',
        'locationId' => '',
      ];
    }else{
      $data['tenant'] = $this->tenant->getData($id);
    }

    $this->load->view('admin/tenant/form', $data);
  }

  public function store(){
    $tenant = $this->tenant;
    $validation = $this->form_validation;
    $validation->set_rules($tenant->rules());
    
    if($validation->run()){
      $tenant->save();
      flashData('success', 'Save data successfully.');
      redirect('tenant');
    }
    
    flashData('danger', 'Save data failed!');
    $this->form();
  }

  public function update(){
    $tenant = $this->tenant;
    $validation = $this->form_validation;
    $validation->set_rules($tenant->rules());

    if($validation->run()){
      $tenant->update();
      flashData('success', 'Update data successfully.');
      redirect('tenant');
    }

    flashData('danger', 'Update data failed!');
    $this->form($this->input->post('id'));
  }

  public function delete(){
    $this->tenant->delete();
  }

  public function loadLocation(){
    $json = [];
    $key = '';

    if(!empty($this->input->get('q'))){
      $key = $this->input->get('q');
    }

    $data = $this->db->like('name', $key)->or_like('code', $key)->get('location')->result();
    echo json_encode($data);
  }

}
