<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('UserModel', 'user');
		$this->load->library('form_validation');
	}

	public function index(){
		$this->load->view('login');
	}
	
	public function login(){
		$user = $this->user;
		$validation = $this->form_validation;
		$validation->set_rules($user->rulesLogin());

		if($validation->run()){
			$type = $this->input->post('type');
			switch ($type) {
				case '1':
					$row = $user->loginTenant()->num_rows();
					$data = $user->loginTenant()->row();
					break;

				case '2':
					$row = $user->login()->num_rows();
					$data = $user->login()->row();
					break;
				
				default:
					# code...
					break;
			}

			if($row > 0){
				$array = [
					'id' => $data->id,
					'name' => $data->name,
					'level' => (empty($data->level))?'3':$data->level,
					'loggedIn' => true
				];

				$this->session->set_userdata($array);

				flashData('success', 'Happy working '.$data->name.'.');
				redirect('dashboard');
			}else{
				flashData('danger', 'Data tidak valid!');
				redirect('auth');
			}
		}

		flashData('danger', 'Data tidak valid!');
		$this->index();
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('auth');
	}

}
