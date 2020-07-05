<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TenantModel extends CI_Model {
    
  public $code;
  public $password;
  public $name;
  public $pic;
  public $phone;
  public $status;
  public $locationId;

  public function rules(){
    $id = '';
    if(empty($this->input->post('id'))){
      $id = '|is_unique[tenant.code]';
    }

    return [
      [
        'field' => 'code',
        'label' => 'code',
        'rules' => 'required'.$id
      ],
      [
        'field' => 'name',
        'label' => 'name',
        'rules' => 'required'
      ],
      [
        'field' => 'pic',
        'label' => 'pic',
        'rules' => 'required'
      ],
      [
        'field' => 'phone',
        'label' => 'phone',
        'rules' => 'required'
      ],
      [
        'field' => 'locationId',
        'label' => 'locationId',
        'rules' => 'required'
      ],
      [
        'field' => 'rent',
        'label' => 'rent',
        'rules' => 'required'
      ]
    ];
  }

  // data
  public function showAll(){
    $status = '';
    if($_GET){
      $status = $_GET['status'];
    }

    return $this->db->like('status', $status)->order_by('code', 'asc')->get('tenant')->result();
  }

  public function getData($id){
    return $this->db
                  ->select('t.id, t.code, t.name, t.pic, t.phone, t.status, t.locationId, t.rent, l.code as codeLocation, l.name as nameLocation')
                  ->from('tenant t')
                  ->join('location l', 'l.id = t.locationId')
                  ->where('t.id', $id)
                  ->get()->row();
  }

  public function getDataActive($id){
    return $this->db
                  ->select('t.id, t.code, t.name, t.pic, t.phone, t.status, t.locationId, t.rent l.code as codeLocation, l.name as nameLocation')
                  ->from('tenant t')
                  ->join('location l', 'l.id = t.locationId')
                  ->where('t.id', $id)
                  ->get()->row();
  }

  public function save(){
    $post = $this->input->post();
    $this->code = $post['code'];
    $this->password = sha1('12345');
    $this->name = $post['name'];
    $this->pic = $post['pic'];
    $this->phone = $post['phone'];
    $this->status = '1';
    $this->locationId = $post['locationId'];
    $this->rent = $post['rent'];

    return $this->db->insert('tenant', $this);
  }

  public function update(){
    $post = $this->input->post();
    $data = array(
      'code' => $post['code'],
      'name' => $post['name'],
      'pic' => $post['pic'],
      'phone' => $post['phone'],
      'status' => $post['status'],
      'locationId' => $post['locationId'],
      'rent' => $post['rent']
    );

    return $this->db->where('id', $post['id'])->update('tenant', $data);
  }

  public function delete(){
    $id = $this->input->post('id');
    
    return $this->db->where('id', $id)->delete('tenant');
  }

  public function resetPassword(){
    $post = $this->input->post();
    $data = array(
      'password' => sha1('12345')
    );

    return $this->db->where('id', $post['id'])->update('tenant', $data);
  }

  public function count(){
    return $this->db->where('status', '1')->get('tenant')->num_rows();
  }
    
}
