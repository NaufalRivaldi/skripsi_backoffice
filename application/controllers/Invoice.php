<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('TenantModel', 'tenant');
    $this->load->model('LocationModel', 'location');
    $this->load->model('InvoiceModel', 'invoice');
		$this->load->library('form_validation');
    $this->load->library('pdf');
    
    cekLogin();
    // cekFinance();
	}

	public function index(){
    $data['title'] = 'Payment';
    $data['no'] = 1;
    $data['invoice'] = $this->invoice->showAll();
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

		$this->load->view('admin/invoice/index', $data);
  }

  public function view($id){
    $data['title'] = 'Payment';
    $data['invoice'] = $this->invoice->getData($id);

    $this->load->view('admin/invoice/view', $data);
  }
    
  public function form($id = null){
    $data['title'] = 'Payment';
    $description = '
- Pembayaran ditransfer ke rekening :
  PT. BANK MANDIRI(PERSERO) TBK-CAB DENPASAR UDAYANA BANK ACCOUNT NUMBER : 1450012561714
  PT. EKA JAYA AGUNG
- Pembayaran di anggap sah apabila dana sudah dikreditkan ke rekening diatas.
- Pembayaran dengan cek / BG diangkap lunas bile cek / BG tersebut dapat diuangkan.
- Denda keterlambatan bayar 0,1% perhari.
    ';
    
    if(empty($id)){
      $data['invoice'] = (object)[
        'id' => '',
        'number' => $this->numberInvoice(),
        'date' => date('Y-m-d'),
        'dueDate' => '10',
        'description' => '',
        'total' => '',
        'ppn' => '',
        'grandTotal' => '',
        'note' => $description,
        'tenantId' => ''
      ];
    }else{
      $data['invoice'] = $this->invoice->getData($id);
    }

    $this->load->view('admin/invoice/form', $data);
  }

  public function store(){
    $invoice = $this->invoice;
    $validation = $this->form_validation;
    $validation->set_rules($invoice->rules());
    
    if($validation->run()){
      $id = $invoice->save();
      flashData('success', 'Invoice has been created.');
      redirect('invoice/view/'.$id);
    }
    
    flashData('danger', 'Error Invoice!');
    $this->form();
  }

  public function update(){
    $invoice = $this->invoice;
    $validation = $this->form_validation;
    $validation->set_rules($invoice->rules());

    if($validation->run()){
      $invoice->update();
      flashData('success', 'Update data is successfuly.');
      redirect('invoice');
    }

    flashData('danger', 'Update data failed!');
    $this->form($this->input->post('id'));
  }

  public function delete(){
    $this->invoice->delete();
  }

  public function print($id){
    $data['title'] = 'Payment';
    $data['invoice'] = $this->invoice->getData($id);

    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = 'invoice';
    $this->pdf->load_view('admin/invoice/print', $data);
  }

  public function loadTenant(){
    $json = [];
    $key = '';

    if(!empty($this->input->get('q'))){
      $key = $this->input->get('q');
    }

    $data = $this->db->like('code', $key)->or_like('name', $key)->get('tenant')->result();
    echo json_encode($data);
  }

  public function loadTenantForm(){
    $json = [];
    $key = '';

    if(!empty($this->input->get('q'))){
      $key = $this->input->get('q');
    }

    $data = $this->db->like('code', $key)->or_like('name', $key)->get('tenant')->result();
    echo json_encode($data);
  }

  public function setTenant(){
    $id = $this->input->get('id');
    $data = $this->tenant->getData($id);

    echo json_encode($data);
  }

  public function numberInvoice(){
    $number = '';
    $tahun = date('y');
    $bulan = date('m');
    $key = 'TD'.$tahun.$bulan;

    $data = $this->invoice->checkNumber($key);
    if(empty($data)){
      $number = 'TD'.$tahun.$bulan.'-1';
    }else{
      $row = explode('-', $data->number);
      $row[1] += 1;
      $number = $row[0].'-'.$row[1];
    }

    return $number;
  }

}
