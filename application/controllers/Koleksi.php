<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Koleksi extends CI_Controller {
	private $type;
	private $typeName;
	public function __construct() {
		parent::__construct();
		$this->load->model('Koleksi_model','kls');
		$this->load->model('Dashboard_model','dsb');
		
		$this->CI =& get_instance();
		$this->load->helper('url');

		$this->typeName=array('Buku','Jurnal','Skripsi','e-Book');
	}

	private function init() {
		if (!$this->session->is_login) 
			redirect('/Login/CheckPageLvl');
			
		if ($this->session->level != 1)
			redirect('/Login/CheckPageLvl');
	}

	public function index() {
		$this->init();
		$this->home($id);
	}

	public function home() {
		$this->init();
		$input = $this->input->post();
		$tp = $this->uri->segment(3);

		if (isset($input) && count($input)>0) {
			$mode = $input['mode']; 
			unset($input['mode']);
			$data_koleksi = $this->kls->get_koleksi_list('*',$input);
		} else {
			$mode = 0;
			$data_koleksi = array();
		}		

		$this->type = $this->checkType($this->uri->segment(3));
		// $this->type = $this->checkType($mode);
		$view_data = array(
			'title' => $this->typeName[$this->type],
			'tipe' => $this->type,
			'mode' => $mode,
			'data' => $data_koleksi,
			'per_input' => $input,
			'tp' => $tp,
			);
		// redirect('Koleksi/home/'.$mode,$view_data);
		$this->load->view('koleksi',$view_data);
	}

	public function detail() {
		$this->init();
		$id = $this->session->id;

		$code = $this->uri->segment(3);

		$data_koleksi = $this->kls->get_koleksi_once(array('koleksi_code' => $code));
		$ratt = $this->dsb->get_ratting('ratting_val',array('anggota_key' => $id, 'koleksi_key' => $code));
		
		$_ratt = (isset($ratt->ratting_val)) ? $ratt->ratting_val : 0;
		$view_data = array(
			'data' => $data_koleksi,
			'ratting' => $_ratt,
			);
		$this->load->view('koleksi_detail',$view_data);
	}

	private function checkType($t) {
		if(array_key_exists($t, $this->typeName))
			return $t;
		return 0;
	}

	public function saveratting() {
		$this->init();
		$input = $this->input->post();
		$id = $this->session->id;
		$this->kls->save_ratting_anggota($input['ratting_val'],$input['koleksi_key'],$id);
		
		$this->HitungRattKoleksi($input['koleksi_key']);

		redirect('Koleksi/detail/'.$input['koleksi_key']);
	}

	private function HitungRattKoleksi($code) {
		$ratt = $this->dsb->get_ratting('AVG(ratting_val)  ratting',array('koleksi_key' => $code));
		$this->kls->save_updatekoleksi(array('koleksi_ratting' => ceil($ratt[0]->ratting)),$code);
		
	}
}
