<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('User_model','user');
		
		$this->CI =& get_instance();
		$this->load->helper('url');
	}

	public function index() {
		$this->login();	
	}

	public function login() {
		$this->load->view('login');	
	}

	public function CheckData() {
		$input = $this->input->post();

		if (isset($input)) {
			if ((isset($input['account_id']) && $input['account_id'] != '') && (isset($input['account_pass']) && $input['account_pass'] != '')) {
				$user_l1 = $this->user->check_user_anggota($input['account_id'], $input['account_pass']);
				if ($user_l1 !== FALSE) {
					$this->set_ses(TRUE,$user_l1);
				} else {
					$user_l2 = $this->user->check_user_staff($input['account_id'], $input['account_pass']);
					if ($user_l2 !== FALSE) {
						$this->set_ses(TRUE,$user_l2);
					} else {
						$this->load->view('login');
					}
				}
			} else {
				redirect('Login');
			}			
		} else {
			redirect('Login');
		}
		
		if ($this->session->has_userdata('is_login')) {
			if ($this->session->has_userdata('is_login') == 1) {
				redirect('/Dashboard/meth');
			} elseif ($this->session->has_userdata('is_login') == 2) {
				redirect('/Dashboard/meth');
			} else {
				redirect('Login');
			}
		} else {
			redirect('Login');
		}
	}

	private function set_ses($set=TRUE, $data) {
		$s_data = array(
			'id' => '',
			'name' => '',
			'level' => 0,
			'is_login' => FALSE,
			);

		if ($set) {
			if ($data['level'] == 1) {
				$_data = array(
					'id' => $data['data_user']['anggota_code'],
					'name' => $data['data_user']['anggota_nama'],
					'level' => $data['level'],
					);
			}

			if ($data['level'] == 2) {
				$_data = array(
					'id' => $data['data_user']['staff_code'],
					'name' => $data['data_user']['staff_nama'],
					'level' => $data['level'],
					'su' => $data['data_user']['admin'],
					);
			}
			
			$s_data = array_merge($s_data,$_data);
			$s_data['is_login'] = TRUE;
		}

		$this->session->set_userdata($s_data);		
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('Login');
	}

	public function CheckPageLvl() {
		if ($this->session->is_login) {
			if ($this->session->level == 1) {
				redirect('/Dashboard');
			} elseif ($this->session->level == 2) {
				redirect('/AdmDashboard');
			} else {
				redirect('Login/logout');
			}
		} else {
			redirect('Login');
		}
	}
}
