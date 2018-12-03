<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdmDashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Dashboard_model','dsb');
		$this->load->model('Koleksi_model','kol');
		
		$this->CI =& get_instance();
		$this->load->helper('url');

		$this->type = array('Buku','Jurnal','Skripsi','e-Book');
	}

	private function init() {
		if (!$this->session->is_login) 
			redirect('/Login/CheckPageLvl');
			
		if ($this->session->level != 2)
			redirect('/Login/CheckPageLvl');
	}

	private function su() {
		if (!$this->session->su) 
			redirect('/AdmDashboard');
	}

	private function adm() {
		if (!$this->session->adm)
			redirect('/Login/CheckPageLvl');
	}

	public function index() {
		$this->init();
		$this->profile();
	}

	public function profile() {
		$this->init();
		
		$input = $this->input->post();
		if (isset($input) && count($input)>0) {
			$this->dsb->save_base('PROFILE',$input);
		}
		

		$base = $this->dsb->get_base('*',array('base_code'=>'PROFILE'));
		$view_data = array(
			'title' => 'Manage Profile',
			'base' => $base,
			);
		$this->load->view('adm_profile',$view_data);
	}

	public function faq() {
		$this->init();
		$view_data = array(
			'title' => 'FAQ',
			);
		$this->load->view('faq',$view_data);
	}

	public function staff() {
		$this->init();
		$this->su();
		$data_staff = $this->dsb->get_staff();
		$view_data = array(
			'title' => array('Tambah Staff','List Staff Perpustakaan'),
			'data' => $data_staff,
			);
		$this->load->view('adm_staff',$view_data);
	}

	public function addstaff() {
		$this->init();
		$this->su();
		$input = $this->input->post();	
		
		$error = array();
		if (!isset($input['staff_code']) || $input['staff_code'] == '')
			$error[] = "NID wajib diisikan";

		if ($this->dsb->duplicate_saff($input['staff_code']) !=0)
			$error[] = "NID sudah terdaftar sebelumnya";
		
		if (!isset($input['staff_nama']) || $input['staff_nama'] == '')
			$error[] = "Nama wajib diisikan";
		
		if (!isset($input['staff_jabatan']) || $input['staff_jabatan'] == '')
			$error[] = "Jabtan wajib diisikan";
			
		$is_error = $this->error($error);

		if ($is_error) {	
			redirect('/AdmDashboard/staff');
		} else {
			$input['staff_pass'] = $input['staff_code'];
			$this->dsb->save_addstaff($input);
			$this->success(array("<b>".$input['staff_nama']."</b>, berhasil ditambahkan"));
			redirect('/AdmDashboard/staff');
		}	
	}

	public function updatestaff() {
		$this->init();
		$this->su();
		$input = $this->input->post();	
		
		$error = array();
		if (!isset($input) || count($input)<=0)
			redirect('/AdmDashboard/staff');
		
		if (!isset($input['staff_code']) || $input['staff_code'] == '')
			$error[] = "NID wajib diisikan";

		if ($this->dsb->duplicate_saff($input['staff_code']) !=1)
			$error[] = "NID sudah terdaftar sebelumnya";
		
		if (!isset($input['staff_nama']) || $input['staff_nama'] == '')
			$error[] = "Nama wajib diisikan";
		
		if (!isset($input['staff_jabatan']) || $input['staff_jabatan'] == '')
			$error[] = "Jabtan wajib diisikan";
			
		$is_error = $this->error($error);

		if ($is_error) {	
			redirect('/AdmDashboard/staff');
		} else {
			$code = $input['staff_code'];
			$_data = $input; unset($_data['staff_code']);
			$this->dsb->save_updatestaff($_data,$code);
			$this->success(array("<b>".$input['staff_nama']."</b>, berhasil diubah"));
			redirect('/AdmDashboard/staff');
		}	
	}

	public function hapusstaff() {
		$this->init();
		$this->su();
		$code = $this->uri->segment(3);

		$_back = $this->dsb->get_staff_once(array('staff_code' => $code));
		
		$this->dsb->save_hapusstaff($code);
		$this->success(array("<b>".$_back->staff_nama."</b>, berhasil dihapus"));
		redirect('/AdmDashboard/staff');
	}

	public function koleksi() {
		$this->init();
		
		$cari = '';
		$input = $this->input->post();	
		if (isset($input['cari']) && $input['cari']!='') {
			$cari = $input['cari'];
			$like = array('koleksi_judul' => $input['cari']);
		} else {
			$like = array();
		}

		$data_koleksi = $this->kol->get_koleksi_list('*',$like);
		$view_data = array(
			'title' => 'List Koleksi Perpustakaan',
			'cari' => $cari,
			'data' => $data_koleksi,
			);
		$this->load->view('adm_koleksi_list',$view_data);
	}

	public function detailkoleksi() {
		$this->init();
		$code = $this->uri->segment(3);

		$data_koleksi = $this->kol->get_koleksi('*',array('koleksi_code' => $code));
		if ($data_koleksi === FALSE) redirect('/AdmDashboard/koleksi');
		$view_data = array(
			'data' => $data_koleksi,
			);
		$this->load->view('adm_koleksi_detail',$view_data);
	}

	public function tambahkoleksi() {
		$view_data = array(
			'title' => 'Masukan Info Koleksi',
			'tipe' => $this->type,
			'data' => array(
				'koleksi_code' => '',
				'koleksi_judul' => '',
				'koleksi_tipe' => 0,
				'koleksi_penulis' => '',
				'koleksi_penerbit' => '',
				'koleksi_tahun' => '',
				'koleksi_sinopsis' => '',
				'koleksi_lokasi' => '',
				),
			);
		$this->load->view('adm_koleksi_add',$view_data);
	}

	public function addkoleksi() {
		$this->init();
		$this->load->library('upload');

		$input = $this->input->post();

		$koleksi_gambar_name = "C_";
		$koleksi_file_name = "F_";

		$error = array();

		if (!isset($input) || count($input)<=0)
			$error[] = "Data wajib diisikan";
		
		if (!isset($input['koleksi_judul']) || $input['koleksi_judul'] == '')
			$error[] = "Judul wajib diisikan";

		if (!isset($input['koleksi_penulis']) || $input['koleksi_penulis'] == '')
			$error[] = "Penulis wajib diisikan";
		
		if (!isset($input['koleksi_penerbit']) || $input['koleksi_penerbit'] == '')
			$error[] = "Penerbit wajib diisikan";
		
		if (!isset($input['koleksi_tahun']) || $input['koleksi_tahun'] == '')
			$error[] = "Tahun wajib diisikan";

		$is_error = $this->error($error);

		if ($is_error) {	
			$view_data = array(
				'title' => 'Masukan Info Koleksi',
				'tipe' => $this->type,
				'data' => $input,
				);
			$this->load->view('adm_koleksi_add',$view_data);
		} else {
			$_data = $input;
			$this->kol->save_addkoleksi($_data);
			$id = $this->db->insert_id();
			
			$cd = array('BK-A', 'JR-A', 'SR-A', 'EB-A');
			$gen_code = $cd[$_data['koleksi_tipe']].$id;
			$upd['koleksi_code'] = $gen_code;

			$koleksi_gambar_name .= str_replace('-', '', $gen_code).time();
			$koleksi_file_name .= str_replace('-', '', $gen_code).time();

			if (isset($_FILES['koleksi_gambar'])) {
				$config['upload_path'] = './up_file/koleksi/';
				$config['file_name'] = $koleksi_gambar_name;
				$config['allowed_types'] = 'png';
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('koleksi_gambar')) {
					$upd['koleksi_sampul'] = 'C_DEF';
				} else {
					$upd['koleksi_sampul'] = $koleksi_gambar_name;
				}
			}

			if (isset($_FILES['koleksi_file'])) {
				$config['upload_path'] = './up_file/koleksi/';
				$config['file_name'] = $koleksi_file_name;
				$config['allowed_types'] = 'pdf';
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('koleksi_file')) {
					$upd['koleksi_file'] = '';
				} else {
					$upd['koleksi_file'] = $koleksi_file_name;
				}
			}

			$this->kol->save_addkoleksi_code($id, $upd);
			$this->success(array("<b>".$input['koleksi_judul']."</b>, berhasil ditambahkan"));
			redirect('/AdmDashboard/koleksi');
		}	
	}

	public function ubahkoleksi() {
		$this->init();
		$input = $this->input->post();
		// echo "<pre>";
		// print_r($input);
		// echo "</pre>";
		// exit;
		$error = array();
		if (!isset($input['code'])) {
			$error[] = "Data tidak diketemukan";
			$this->error($error);
			redirect('/AdmDashboard/koleksi');
		}

		$code = $input['code']; unset($input['code']);

		if (!isset($input) || count($input)<=0)
			$error[] = "Data wajib diisikan";
		
		if (!isset($input['koleksi_judul']) || $input['koleksi_judul'] == '')
			$error[] = "Judul wajib diisikan";

		if (!isset($input['koleksi_penulis']) || $input['koleksi_penulis'] == '')
			$error[] = "Penulis wajib diisikan";
		
		if (!isset($input['koleksi_penerbit']) || $input['koleksi_penerbit'] == '')
			$error[] = "Penerbit wajib diisikan";
		
		if (!isset($input['koleksi_tahun']) || $input['koleksi_tahun'] == '')
			$error[] = "Tahun wajib diisikan";

		$is_error = $this->error($error);

		if ($is_error) {	
			redirect('/AdmDashboard/detailkoleksi/'.$code);
		} else {
			$_data = $input;
			$this->kol->save_updatekoleksi($_data,$code);
			$this->success(array("<b>".$input['koleksi_judul']."</b>, berhasil diubah"));
			redirect('/AdmDashboard/detailkoleksi/'.$code);
		}	
	}

	public function ubahkoleksifile() {
		$this->init();
		$input = $this->input->post();
		$this->load->library('upload');
		// echo "<pre>";
		// print_r($input);
		// print_r(($_FILES['koleksi_gambar']['name']));
		// print_r(($_FILES['koleksi_file']['name']));
		// echo "</pre>";
		// exit;
		$error = array();
		$koleksi_gambar_name = "C_";
		$koleksi_file_name = "F_";
		
		if (isset($_FILES['koleksi_gambar']['name']) && $_FILES['koleksi_gambar']['name']!="") {
			$koleksi_gambar_name.=str_replace('-', '', $input['sub_img']).time();
			$config['upload_path'] = './up_file/koleksi/';
			$config['file_name'] = $koleksi_gambar_name;
			$config['allowed_types'] = 'png';
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('koleksi_gambar')) {
				$error[] = "Gambar tidak sesuai";
			} else {
				$code = $input['sub_img'];
				$upd['koleksi_sampul'] = $koleksi_gambar_name;
			}
		} 

		if (isset($_FILES['koleksi_file']['name']) && $_FILES['koleksi_file']['name']!="") {
			$koleksi_file_name.=str_replace('-', '', $input['sub_file']).time();
			$config['upload_path'] = './up_file/koleksi/';
			$config['file_name'] = $koleksi_file_name;
			$config['allowed_types'] = 'pdf';
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('koleksi_file')) {
				$error[] = "File tidak sesuai";
			} else {
				$code = $input['sub_file'];
				$upd['koleksi_file'] = $koleksi_file_name;
			}
		}

		if (isset($input['del_img'])) {
			$upd['koleksi_sampul']='C_DEF';
			$code = $input['del_img'];
		}

		if (isset($input['del_file'])) {
			$upd['koleksi_file']='';
			$code = $input['del_img'];
		}

		$is_error = $this->error($error);

		if ($is_error) {	
			redirect('/AdmDashboard/detailkoleksi/'.$code);
		} else {
			$this->kol->save_updatekoleksi($upd,$code);
			$this->success(array("Berkas berhasil diubah"));
			redirect('/AdmDashboard/detailkoleksi/'.$code);
		}	
	}

	public function hapuskoleksi() {
		$this->init();
		$input = $this->input->post();
		
		$code = $input['code'];

		$_back = $this->kol->get_koleksi_once(array('koleksi_code' => $code));
		
		$this->kol->save_hapuskoleksi($code);
		$this->dsb->save_hapusratting($code);
		$this->success(array("<b>".$_back->koleksi_judul."</b>, berhasil dihapus"));
		redirect('/AdmDashboard/koleksi');
	}

	public function anggota() {
		$this->init();
		$data_staff = $this->dsb->get_anggota();
		$view_data = array(
			'title' => array('Tambah Anggota','List Anggota Perpustakaan'),
			'data' => $data_staff,
			);
		$this->load->view('adm_anggota',$view_data);
	}

	public function addanggota() {
		$this->init();
		$input = $this->input->post();	
		
		$error = array();
		if (!isset($input['anggota_code']) || $input['anggota_code'] == '')
			$error[] = "NIK wajib diisikan";

		if ($this->dsb->duplicate_anggota($input['anggota_code']) !=0)
			$error[] = "NIK sudah terdaftar sebelumnya";
		
		if (!isset($input['anggota_nama']) || $input['anggota_nama'] == '')
			$error[] = "Nama wajib diisikan";
		
		$is_error = $this->error($error);

		if ($is_error) {	
			redirect('/AdmDashboard/anggota');
		} else {
			$input['anggota_pass'] = $input['anggota_code'];
			$this->dsb->save_addanggota($input);
			$this->success(array("<b>".$input['anggota_nama']."</b>, berhasil ditambahkan"));
			redirect('/AdmDashboard/anggota');
		}	
	}

	public function updateanggota() {
		$this->init();
		$input = $this->input->post();	
		$error = array();
		if (!isset($input) || count($input)<=0)
			redirect('/AdmDashboard/anggota');
		
		if (!isset($input['anggota_code']) || $input['anggota_code'] == '')
			$error[] = "NIK wajib diisikan";

		if ($this->dsb->duplicate_anggota($input['anggota_code']) !=1)
			$error[] = "NIK sudah terdaftar sebelumnya";
		
		if (!isset($input['anggota_nama']) || $input['anggota_nama'] == '')
			$error[] = "Nama wajib diisikan";
		
		$is_error = $this->error($error);

		if ($is_error) {	
			redirect('/AdmDashboard/anggota');
		} else {
			$code = $input['anggota_code'];
			$_data = $input; unset($_data['anggota_code']);
			$this->dsb->save_updateanggota($_data,$code);
			$this->success(array("<b>".$input['anggota_nama']."</b>, berhasil diubah"));
			redirect('/AdmDashboard/anggota');
		}	
	}

	public function hapusanggota() {
		$code = $this->uri->segment(3);

		$_back = $this->dsb->get_anngota_once(array('anggota_code' => $code));
		
		$this->dsb->save_hapusanggota($code);
		$this->success(array("<b>".$_back->anggota_nama."</b>, berhasil dihapus"));
		redirect('/AdmDashboard/anggota');
	}

	private function error($msg=array()) {
		$this->load->library('session');
		$f_data['error'] = (count($msg)>0) ? TRUE : FALSE;
		$f_data['msg'] = $msg;
		$this->session->set_flashdata($f_data);

		return $f_data['error'];
	}

	private function success($msg=array()) {
		$this->load->library('session');
		$f_data['success'] = (count($msg)>0) ? TRUE : FALSE;
		$f_data['msg'] = $msg;
		$this->session->set_flashdata($f_data);
	}

	public function keanggotaan() {
		$this->init();

		$input = $this->input->post();
		if (isset($input) && count($input)>0) {
			$this->dsb->save_base('ANGGOTA',$input);
		}

		$base = $this->dsb->get_base('*',array('base_code'=>'ANGGOTA'));

		// echo $this->CI->db->last_query();exit();
		$view_data = array(
			'title' => 'Manage Ketentian Keanggotaan',
			'base' => $base,
			);
		$this->load->view('adm_keanggotaan',$view_data);
	}

	public function pengaturan() {
		$this->init();
		$history = array();
		
		$staff = $this->dsb->get_staff_once(array('staff_code' => $this->session->id));
		$view_data = array(
			'title' => array('Photo Prifil','Password'),
			'data' => $staff,
			);
		$this->load->view('adm_pengaturan',$view_data);
	}

	public function updatepass() {
    	$this->init();
		$input = $this->input->post();
		$this->load->library('upload');

		$staff = $this->dsb->get_staff_once(array('staff_code' => $this->session->id));
		// echo "<pre>";
		// print_r($input);
		// print_r($anggota);
		// echo "</pre>";
		// exit();
		
		$error = array();
		if (!isset($input) || count($input)<=0)
			redirect('/Dashboard/pengaturan');
		
		if (!isset($input['pass_new']) || $input['pass_new'] == '')
			$error[] = "Password baru harus diisikan";

		if (!isset($input['pass_old']) || $input['pass_old'] == '')
			$error[] = "Password sebelummnya harus diisikan";
		
		if ($input['pass_old'] != $staff->staff_pass)
			$error[] = "Password sebelummnya tidak cocok";
		
		$is_error = $this->error($error);

		if ($is_error) {	
			redirect('/AdmDashboard/pengaturan');
		} else {
			$code = $staff->staff_code;
			$_data['staff_pass'] = $input['pass_new'];
			$this->dsb->save_updatestaff($_data,$code);
			$this->success(array("Password berhasil diubah"));
			redirect('AdmDashboard/pengaturan');
		}
    }

    public function updateimguser() {
    	$this->init();
		$input = $this->input->post();
		$this->load->library('upload');
		$staff = $this->dsb->get_staff_once(array('staff_code' => $this->session->id));
		$img_name = $staff->staff_foto.time();
		$error = array();
		
		if (isset($_FILES['staff_img']) && !isset($input['del_img'])) {
			$config['upload_path'] = './up_file/staff/';
			$config['file_name'] = $img_name;
			$config['allowed_types'] = 'jpg';
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('staff_img')) {
				$error[] = "Gambar tidak sesuai";
			} else {
				$code = $staff->staff_code;
				$upd['staff_foto'] = $img_name;
			}
		}

		if (isset($input['del_img'])) {
			$upd['staff_foto']='';
			$code = $staff->staff_code;
		}

		$is_error = $this->error($error);

		if ($is_error) {	
			redirect('/AdmDashboard/pengaturan/'.$code);
		} else {
			$this->dsb->save_updatestaff($upd,$code);
			$this->success(array("Foto berhasil diubah"));
			redirect('/AdmDashboard/pengaturan');
		}
    }
}
