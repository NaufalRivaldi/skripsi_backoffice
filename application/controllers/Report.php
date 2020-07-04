<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('TenantModel', 'tenant');
    $this->load->model('LocationModel', 'location');
    $this->load->model('InvoiceModel', 'invoice');
		$this->load->library('form_validation');
    $this->load->library('pdf');
    
    cekLogin();
	}

	public function index(){
    $data['title'] = 'Report';
    $data['no'] = 1;
    
    if($_GET){
      $data['filter'] = (object)[
        'dateA' => $_GET['dateA'],
        'dateB' => $_GET['dateB']
      ];
      $data['invoice'] = $this->invoice->showAll();
    }else{
      $data['filter'] = (object)[
        'dateA' => '',
        'dateB' => ''
      ];
    }

		$this->load->view('admin/report/index', $data);
  }

  public function pembayaran(){
    $data['title'] = 'Payment';
    $data['no'] = 1;
    $data['invoice'] = $this->invoice->showSpec();
    if($_GET){
      $data['filter'] = (object)[
        'dateA' => $_GET['dateA'],
        'dateB' => $_GET['dateB']
      ];
    }else{
      $data['filter'] = (object)[
        'dateA' => '',
        'dateB' => ''
      ];
    }

		$this->load->view('admin/report/invoicetenant', $data);
  }

  public function view($id){
    $data['title'] = 'Payment';
    $data['invoice'] = $this->invoice->getData($id);

    $this->load->view('admin/report/view', $data);
  }

  public function print(){
    $data['title'] = 'Payment';
    $data['invoice'] = $this->invoice->showReport();
    $data['no'] = 1;

    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = 'invoice';
    $this->pdf->load_view('admin/report/print', $data);
  }

  public function loadTenant(){
    $json = [];
    $key = '';

    if(!empty($this->input->get('q'))){
      $key = $this->input->get('q');
    }

    $data = $this->db->like('kode', $key)->or_like('nama', $key)->get('tenant')->result();
    echo json_encode($data);
  }

  public function setTenant(){
    $id = $this->input->get('id');
    $data = $this->tenant->getData($id);

    echo json_encode($data);
  }

}
