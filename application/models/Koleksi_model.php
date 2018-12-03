<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Koleksi_model extends CI_Model {

	private $table1;
	private $table2;

	public function __construct() {
		parent::__construct();

		$this->table1 = 'koleksi';
		$this->table2 = 'ratting';
	}

	public function get_koleksi_once($where) {
		$this->CI->db->where($where);
		$query = $this->CI->db->get($this->table1);
		
		return $query->row();
	}

	public function get_koleksi_list($select='*',$like=array()) {
		$this->CI->db->select($select);
		$this->CI->db->from($this->table1);
		$this->CI->db->like($like);
		$query = $this->CI->db->get();
		
		return $query->result();
	}

	public function get_koleksi($select='*',$where=array()) {
		$this->CI->db->select($select);
		$this->CI->db->from($this->table1);
		$this->CI->db->where($where);
		$query = $this->CI->db->get();
		
		if ($query->num_rows() > 0) return $query->row();
		return FALSE;
	}

	public function save_addkoleksi($data) {
		$this->CI->db->insert($this->table1,$data);
	}

	public function save_addkoleksi_code($id,$data) {
		$this->CI->db->where('koleksi_id',$id);
		$this->CI->db->update($this->table1,$data);
	}

	public function save_updatekoleksi($data,$code) {
		$this->CI->db->where('koleksi_code',$code);
		$this->CI->db->update($this->table1,$data);
	}

	public function save_hapuskoleksi($code) {
		$this->CI->db->where('koleksi_code',$code);
		$this->CI->db->delete($this->table1);
	}

	public function save_ratting_anggota($ratting,$koleksi,$id) {
		if ($this->CheckRatt($koleksi,$id)) {
			$this->CI->db->where('anggota_key',$id);
			$this->CI->db->where('koleksi_key',$koleksi);
			$this->CI->db->update($this->table2,array('ratting_val'=>$ratting));
		} else {
			$this->CI->db->insert($this->table2,array('ratting_val'=>$ratting,'koleksi_key'=>$koleksi,'anggota_key'=>$id));
		}
	}

	public function CheckRatt($koleksi,$id) {
		$this->CI->db->from($this->table2);
		$this->CI->db->where('anggota_key',$id);
		$this->CI->db->where('koleksi_key',$koleksi);
		$query = $this->CI->db->get();

		if ($query->num_rows() > 0) return TRUE;
		
		return FALSE;
	}
}