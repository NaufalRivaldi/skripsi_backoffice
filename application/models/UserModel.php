<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {
    
    public $name;
    public $username;
    public $password;
    public $level;
    public $status = '1';

    public function rulesLogin(){
      return [
        [
          'field' => 'type',
          'label' => 'type',
          'rules' => 'required'
        ],
        [
          'field' => 'username',
          'label' => 'username',
          'rules' => 'required'
        ],
        [
          'field' => 'password',
          'label' => 'password',
          'rules' => 'required'
        ]
      ];
    }

    public function rules(){
      return [
        [
          'field' => 'name',
          'label' => 'name',
          'rules' => 'required'
        ],
        [
          'field' => 'username',
          'label' => 'username',
          'rules' => 'required'
        ],
        [
          'field' => 'level',
          'label' => 'level',
          'rules' => 'required'
        ]
      ];
    }

    public function rulesRePassword(){
      return [
        [
          'field' => 'passwordOld',
          'label' => 'passwordOld',
          'rules' => 'required'
        ],
        [
          'field' => 'passwordNew1',
          'label' => 'passwordNew1',
          'rules' => 'required'
        ],
        [
          'field' => 'passwordNew2',
          'label' => 'passwordNew2',
          'rules' => 'required|matches[passwordNew1]'
        ]
      ];
    }

    // data
    public function showAll(){
      $level = '';
      $status = '';
      if($_GET){
        $level = $_GET['level'];
        $status = $_GET['status'];
      }
      return $this->db->like('level', $level)->like('status', $status)->order_by('name', 'asc')->get('user')->result();
    }

    public function getData($id){
      return $this->db->where('id', $id)->get('user')->row();
    }

    public function save(){
      $post = $this->input->post();
      $this->name = $post['name'];
      $this->username = $post['username'];
      $this->password = sha1('12345');
      $this->level = $post['level'];
      $this->status = '1';

      return $this->db->insert('user', $this);
    }

    public function update(){
      $post = $this->input->post();
      $data = array(
        'name' => $post['name'],
        'username' => $post['username'],
        'level' => $post['level'],
        'status' => $post['status']
      );

      return $this->db->where('id', $post['id'])->update('user', $data);
    }

    public function delete(){
      $id = $this->input->post('id');
      
      return $this->db->where('id', $id)->delete('user');
    }

    public function resetPassword(){
      $id = $this->input->post('id');
      $data = array(
        'password' => sha1('12345')
      );

      return $this->db->where('id', $id)->update('user', $data);
    }

    public function rePassword(){
      $post = $this->input->post();
      $passwordOld = sha1($post['passwordOld']);
      $passwordNew = sha1($post['passwordNew1']);
      $data = $this->db->where('id', $this->session->userData('id'))->where('password', $passwordOld)->get('user')->row();

      if(!empty($data)){
        $array = array(
          'password' => $passwordNew
        );

        $this->db->where('id', $this->session->userData('id'))->update('user', $array);

        return true;
      }else{
        return false;
      }
    }

    public function rePasswordTenant(){
      $post = $this->input->post();
      $passwordOld = sha1($post['passwordOld']);
      $passwordNew = sha1($post['passwordNew1']);
      $data = $this->db->where('id', $this->session->userData('id'))->where('password', $passwordOld)->get('tenant')->row();

      if(!empty($data)){
        $array = array(
          'password' => $passwordNew
        );

        $this->db->where('id', $this->session->userData('id'))->update('tenant', $array);

        return true;
      }else{
        return false;
      }
    }

    // login
    public function login(){
      $post = $this->input->post();
      $this->username = $post['username'];
      $this->password = sha1($post['password']);

      return $this->db->where('username', $this->username)->where('password', $this->password)->where('status', '1')->get('user');
    }

    public function loginTenant(){
      $post = $this->input->post();
      $this->username = $post['username'];
      $this->password = sha1($post['password']);

      return $this->db->where('kode', $this->username)->where('password', $this->password)->get('tenant');
    }
    
}
