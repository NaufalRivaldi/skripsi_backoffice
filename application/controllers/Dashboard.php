<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
  
  public function __construct(){
    parent::__construct();

    $this->load->model('TenantModel', 'tenant');
    $this->load->model('InvoiceModel', 'invoice');

    cekLogin();
  }
	public function index(){
    $data['title'] = 'Dashboard';
    $data['countTenant'] = $this->tenant->count();
    
    if($this->session->userData('level') == '3'){
      $data['tenant'] = $this->tenant->getData($this->session->userData('id'));
      $data['cekPembayaran'] = $this->invoice->cekPembayaran($this->session->userData('id'));
    }

		$this->load->view('admin/dashboard/index', $data);
  }
  
}
