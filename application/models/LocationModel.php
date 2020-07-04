<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LocationModel extends CI_Model {
    
  public $code;
  public $name;

  public function rules(){
    $id = '|is_unique[location.code]';
    if(!empty($this->input->post('id'))){
      $id = '';
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
      ]
    ];
  }

  // data
  public function showAll(){
    return $this->db->order_by('code', 'asc')->get('location')->result();
  }

  public function getData($id){
    return $this->db->where('id', $id)->get('location')->row();
  }

  public function save(){
    $post = $this->input->post();
    $this->code = $post['code'];
    $this->name = $post['name'];

    return $this->db->insert('location', $this);
  }

  public function update(){
    $post = $this->input->post();
    $data = array(
      'code' => $post['code'],
      'name' => $post['name']
    );

    return $this->db->where('id', $post['id'])->update('location', $data);
  }

  public function delete(){
    $id = $this->input->post('id');
    
    return $this->db->where('id', $id)->delete('location');
  }
    
}
