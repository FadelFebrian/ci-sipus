<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	private $table1;
	private $table2;
	private $table3;
	private $table4;
	private $table5;

	public function __construct() {
		parent::__construct();

		$this->table1 = 'staff';
		$this->table2 = 'anggota';
		$this->table3 = 'koleksi';
		$this->table4 = 'ratting';
		$this->table5 = 'base';
	}
	
	public function get_base($select='*',$where=array()) {
		$this->CI->db->select($select);
		$this->CI->db->from($this->table5);
		$this->CI->db->where($where);
		$query = $this->CI->db->get();
		
		return $query->row();
	}
	
	public function get_staff() {
		$query = $this->CI->db->get($this->table1);
		
		return $query->result();
	}

	public function get_staff_once($where) {
		$this->CI->db->where($where);
		$query = $this->CI->db->get($this->table1);
		
		return $query->row();
	}

	public function get_anngota_once($where) {
		$this->CI->db->where($where);
		$query = $this->CI->db->get($this->table2);
		
		return $query->row();
	}

	public function get_anggota($select='*',$where=array()) {
		$this->CI->db->select($select);
		$this->CI->db->from($this->table2);
		$query = $this->CI->db->get();
		
		return $query->result();
	}

	public function get_koleksi($select='*',$where=array()) {
		$this->CI->db->select($select);
		$this->CI->db->from($this->table3);
		$this->CI->db->where($where);
		$query = $this->CI->db->get();
		
		return $query->result();
	}

	public function get_ratting($select='*',$where=array()) {
		$this->CI->db->select($select);
		$this->CI->db->from($this->table4);
		$this->CI->db->where($where);
		$query = $this->CI->db->get();
		
		return $query->result();
	}

	public function save_base($code='',$data=array()) {
		$this->CI->db->where('base_code',$code);
		$this->CI->db->update($this->table5,$data);
	}

	public function duplicate_saff($code='') {
		$this->CI->db->from($this->table1);
		$this->CI->db->where('staff_code',$code);
		$query = $this->CI->db->get();

		return $query->num_rows();
	}

	public function save_addstaff($data) {
		$this->CI->db->insert($this->table1,$data);
	}

	public function save_updatestaff($data,$code) {
		$this->CI->db->where('staff_code',$code);
		$this->CI->db->update($this->table1,$data);
	}

	public function save_hapusstaff($code) {
		$this->CI->db->where('staff_code',$code);
		$this->CI->db->delete($this->table1);
	}

	#
	public function duplicate_anggota($code='') {
		$this->CI->db->from($this->table2);
		$this->CI->db->where('anggota_code',$code);
		$query = $this->CI->db->get();

		return $query->num_rows();
	}

	public function save_addanggota($data) {
		$this->CI->db->insert($this->table2,$data);
	}

	public function save_updateanggota($data,$code) {
		$this->CI->db->where('anggota_code',$code);
		$this->CI->db->update($this->table2,$data);
	}

	public function save_hapusanggota($code) {
		$this->CI->db->where('anggota_code',$code);
		$this->CI->db->delete($this->table2);
	}

	public function save_hapusratting($code) {
		$this->CI->db->where('koleksi_key',$code);
		$this->CI->db->delete($this->table4);
	}

}