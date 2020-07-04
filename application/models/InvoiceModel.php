<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InvoiceModel extends CI_Model {
    
  public $number;
  public $date;
  public $dueDate;
  public $description;
  public $total;
  public $ppn;
  public $grandTotal;
  public $note;
  public $userId;
  public $tenantId;

  public function rules(){
    $id = '';
    if(empty($this->input->post('id'))){
      $id = '|is_unique[invoice.number]';
    }

    return [
      [
        'field' => 'number',
        'label' => 'number',
        'rules' => 'required'.$id
      ],
      [
        'field' => 'date',
        'label' => 'date',
        'rules' => 'required'
      ],
      [
        'field' => 'dueDate',
        'label' => 'dueDate',
        'rules' => 'required'
      ],
      [
        'field' => 'description',
        'label' => 'description',
        'rules' => 'required'
      ],
      [
        'field' => 'total',
        'label' => 'total',
        'rules' => 'required'
      ],
      [
        'field' => 'ppn',
        'label' => 'ppn',
        'rules' => 'required'
      ],
      [
        'field' => 'grandTotal',
        'label' => 'grandTotal',
        'rules' => 'required'
      ],
      [
        'field' => 'note',
        'label' => 'note',
        'rules' => 'required'
      ],
      [
        'field' => 'tenantId',
        'label' => 'tenantId',
        'rules' => 'required'
      ]
    ];
  }

  // data
  public function showAll(){
    $tenantId = '';
    $dateA = '';
    $dateB = '';
    if($_GET){
      if(!empty($_GET['tenantId'])){
        $tenantId = $_GET['tenantId'];
      }
      $dateA = $_GET['dateA'];
      $dateB = $_GET['dateB'];
      
      if(empty($dateB)){
        return $this->db
                ->select('i.id, i.number, i.date, i.dueDate, i.grandTotal, i.userId, i.tenantId, t.code as codeTenant, t.name as nameTenant')
                ->from('invoice i')
                ->join('tenant t', 't.id = i.tenantId')
                ->order_by('i.date', 'desc')
                ->like('i.tenantId', $tenantId)
                ->like('i.date', $dateA)
                ->get()->result();
      }else{
        return $this->db
                ->select('i.id, i.number, i.date, i.dueDate, i.grandTotal, i.userId, i.tenantId, t.code as codeTenant, t.name as nameTenant')
                ->from('invoice i')
                ->join('tenant t', 't.id = i.tenantId')
                ->order_by('i.date', 'desc')
                ->like('i.tenantId', $tenantId)
                ->where('i.date >=', $dateA)
                ->where('i.date <=', $dateB)
                ->get()->result();
      }
    }

    return $this->db
                ->select('i.id, i.number, i.date, i.dueDate, i.grandTotal, i.userId, i.tenantId, t.code as codeTenant, t.name as nameTenant')
                ->from('invoice i')
                ->join('tenant t', 't.id = i.tenantId')
                ->order_by('i.date', 'desc')
                ->like('i.tenantId', $tenantId)
                ->get()->result();
  }

  public function showSpec(){
    $tenantId = '';
    $dateA = '';
    $dateB = '';
    if($_GET){
      if(!empty($_GET['tenantId'])){
        $tenantId = $_GET['tenantId'];
      }
      $dateA = $_GET['dateA'];
      $dateB = $_GET['dateB'];
      
      if(empty($dateB)){
        return $this->db
                ->select('i.id, i.number, i.date, i.dueDate, i.grandTotal, i.userId, i.tenantId, t.code as codeTenant, t.name as nameTenant')
                ->from('invoice i')
                ->join('tenant t', 't.id = i.tenantId')
                ->order_by('i.date', 'desc')
                ->like('i.tenantId', $tenantId)
                ->like('i.date', $dateA)
                ->where('i.tenantId', $this->session->userData('id'))
                ->get()->result();
      }else{
        return $this->db
                ->select('i.id, i.number, i.date, i.dueDate, i.grandTotal, i.userId, i.tenantId, t.code as codeTenant, t.name as nameTenant')
                ->from('invoice i')
                ->join('tenant t', 't.id = i.tenantId')
                ->order_by('i.date', 'desc')
                ->like('i.tenantId', $tenantId)
                ->where('i.date >=', $dateA)
                ->where('i.date <=', $dateB)
                ->where('i.tenantId', $this->session->userData('id'))
                ->get()->result();
      }
    }

    return $this->db
                ->select('i.id, i.number, i.date, i.dueDate, i.grandTotal, i.userId, i.tenantId, t.code as codeTenant, t.name as nameTenant')
                ->from('invoice i')
                ->join('tenant t', 't.id = i.tenantId')
                ->order_by('i.date', 'desc')
                ->like('i.tenantId', $tenantId)
                ->where('i.tenantId', $this->session->userData('id'))
                ->get()->result();
  }

  public function showReport(){
    $tenantId = '';
    $dateA = '';
    $dateB = '';
    if(!empty($_GET['tenantId'])){
      $tenantId = $_GET['tenantId'];
    }
    $dateA = $_GET['dateA'];
    $dateB = $_GET['dateB'];
    
    if(empty($dateB)){
      return $this->db
              ->select('i.id, i.number, i.date, i.dueDate, i.grandTotal, i.userId, i.tenantId, t.code as codeTenant, t.name as nameTenant')
              ->from('invoice i')
              ->join('tenant t', 't.id = i.tenantId')
              ->order_by('i.date', 'asc')
              ->like('i.tenantId', $tenantId)
              ->like('i.date', $dateA)
              ->get()->result();
    }else{
      return $this->db
              ->select('i.id, i.number, i.date, i.dueDate, i.grandTotal, i.userId, i.tenantId, t.code as codeTenant, t.name as nameTenant')
              ->from('invoice i')
              ->join('tenant t', 't.id = i.tenantId')
              ->order_by('i.date', 'asc')
              ->like('i.tenantId', $tenantId)
              ->where('i.date >=', $dateA)
              ->where('i.date <=', $dateB)
              ->get()->result();
    }
  }


  public function getData($id){
    return $this->db
                ->select('i.id, i.number, i.date, i.dueDate, i.description, i.total, i.ppn, i.grandTotal, i.note, i.tenantId, t.code as codeTenant, t.name as nameTenant, t.pic, t.phone')
                ->from('invoice i')
                ->join('tenant t', 't.id = i.tenantId')
                ->where('i.id', $id)
                ->get()->row();
  }

  public function showTenantInvoice($id){
    return $this->db
                ->select('i.id, i.number, i.date, i.dueDate, i.grandTotal, i.userId, i.tenantId, t.code as codeTenant, t.name as nameTenant')
                ->from('invoice i')
                ->join('tenant t', 't.id = i.tenantId')
                ->order_by('i.date', 'desc')
                ->where('i.tenantId', $id)
                ->get()->result();
  }

  public function cekPembayaran($id){
    return $this->db
                ->select('i.id, i.number, i.date, i.dueDate, i.grandTotal, i.userId, i.tenantId, t.code as codeTenant, t.name as nameTenant')
                ->from('invoice i')
                ->join('tenant t', 't.id = i.tenantId')
                ->where('i.tenantId', $id)
                ->like('i.date', date('Y-m'))
                ->get()->row();
  }

  public function save(){
    $post = $this->input->post();
    $jatuhTempo = date('Y-m-d', strtotime($post['date'] . '+'.$post['jatuhTempo'].' day'));

    $this->number = $post['number'];
    $this->date = $post['date'];
    $this->dueDate = $jatuhTempo;
    $this->description = $post['description'];
    $this->total = $post['total'];
    $this->ppn = $post['ppn'];
    $this->grandTotal = $post['grandTotal'];
    $this->note = $post['note'];
    $this->userId = $this->session->userData('id');
    $this->tenantId = $post['tenantId'];

    $this->db->insert('invoice', $this);

    $data = $this->db->order_by('id', 'desc')->get('invoice')->row();
    return $data->id;
  }

  public function update(){
    $post = $this->input->post();
    $jatuhTempo = date('Y-m-d', strtotime($post['date'] . '+'.$post['jatuhTempo'].' day'));
    $data = array(
      'number' => $post['number'],
      'date' => $post['date'],
      'dueDate' => $jatuhTempo,
      'description' => $post['description'],
      'total' => $post['total'],
      'ppn' => $post['ppn'],
      'grandTotal' => $post['grandTotal'],
      'note' => $post['note'],
      'userId' => $this->session->userData('id'),
      'tenantId' => $post['tenantId']
    );

    return $this->db->where('id', $post['id'])->update('invoice', $data);
  }

  public function delete(){
    $id = $this->input->post('id');
    
    return $this->db->where('id', $id)->delete('invoice');
  }

  public function checkNumber($key){
    $data = $this->db->select('id, number')->like('number', $key)->order_by('id', 'desc')->get('invoice')->row();

    return $data;
  }
    
}
