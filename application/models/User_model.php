<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	private $table1;
	private $table2;

	public function __construct() {
		parent::__construct();

		$this->table1 = 'anggota';
		$this->table2 = 'staff';
	}

	public function check_user_anggota($id, $pass) {
		$this->CI->db->from($this->table1);
		$this->CI->db->where('anggota_code',$id);
		$this->CI->db->where('anggota_pass',$pass);
		$query = $this->CI->db->get();

		if ($query->num_rows() > 0) {
			$data = array(
				'data_user' => $query->row_array(),
				'level' => 1,
				);
			return $data;
		} else {
			return FALSE;
		}
		
	}

	public function check_user_staff($id, $pass) {
		$this->CI->db->from($this->table2);
		$this->CI->db->where('staff_code',$id);
		$this->CI->db->where('staff_pass',$pass);
		$query = $this->CI->db->get();

		if ($query->num_rows() > 0) {
			$data = array(
				'data_user' => $query->row_array(),
				'level' => 2,
				);
			return $data;
		} else {
			return FALSE;
		}
		
	}
}