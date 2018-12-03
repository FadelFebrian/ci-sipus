<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Dashboard_model','dsb');
		$this->load->model('Koleksi_model','kol');
		
		$this->CI =& get_instance();
		$this->load->helper(array('url','download'));

		$this->type = array('Buku','Jurnal','Skripsi','e-Book');
	}

	private function init() {
		if (!$this->session->is_login) 
			redirect('/Login/CheckPageLvl');
			
		if ($this->session->level != 1)
			redirect('/Login/CheckPageLvl');
	}

	public function index() {
		$this->init();
		$this->meth();
	}

	public function profile() {
		$this->init();
		$base = $this->dsb->get_base('*',array('base_code'=>'PROFILE'));
		$view_data = array(
			'title' => 'Profile',
			'base' => $base,
			);
		$this->load->view('dashboard',$view_data);
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
		$data_staff = $this->dsb->get_staff();
		$view_data = array(
			'title' => 'Staff Perpustakaan',

			'data' => $data_staff,
			);
		$this->load->view('staff',$view_data);
	}

	public function anggota() {
		$this->init();
		$base = $this->dsb->get_base('*',array('base_code'=>'ANGGOTA'));
		$view_data = array(
			'title' => 'Keangotaan',
			'base' => $base,
			);
		$this->load->view('anggota',$view_data);
	}

	public function pengaturan() {
		$this->init();
		$history = array();
		$ratt = $this->dsb->get_ratting('*',array('anggota_key' => $this->session->id));
		
		if (count($ratt) > 0) {
			foreach ($ratt as $value) {
				$judul = $this->kol->get_koleksi_once(array('koleksi_code'=>$value->koleksi_key))->koleksi_judul;
				
				$history[] = array(
					'code' => $value->koleksi_key,
					'judul' => $judul,
					'ratting' => $value->ratting_val,
					);
			}
		}

		$view_data = array(
			'title' => array('Pengaturan Akun','History'),
			'history' => $history,
			);
		$this->load->view('pengaturan',$view_data);
	}

	public function meth() {
		$this->init();
		$user = $this->session->id;
		$data = $this->linkdata();
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// exit();
		$suges = array();

		if (array_key_exists($user, $data)) {
			if ($this->check_isNull($data)) {
				$ranks = $this->GetRecomentByAnggota($data,$user);
			} else {
				$ranks = $this->GetRecomentByRatting();
			}
    	} else {
			$ranks = $this->GetRecomentByRatting();
    	}


	    array_multisort($ranks, SORT_DESC);


        foreach ($ranks as $key => $value) {
	    	$koleksi = $this->kol->get_koleksi_once(array('koleksi_code' => $key));
        	$suges[$koleksi->koleksi_tipe][$key]['detail'] = $koleksi;
        	$suges[$koleksi->koleksi_tipe][$key]['nilai'] = $value;
        }

        $all_ratt = $this->GetRecomentByRatting();
	    array_multisort($all_ratt, SORT_DESC);
        $top_ratt = array();

        $i=0; foreach ($all_ratt as $a_key => $a_value) {
        	if ($i < 5) {
	        	$koleksi = $this->kol->get_koleksi_once(array('koleksi_code' => $a_key));
	        	$top_ratt[$a_key]['detail'] = $koleksi;
	        	$top_ratt[$a_key]['nilai'] = $a_value;
        	}
        	$i+=1;
        }
        
    	$view_data = array(
			// 'title' => 'Output Metode Untuk "'.$this->session->name.'"',
			'title' => 'Direkomendasikan Untuk Anda',
			'tipe' => $this->type,
			'suges' => $suges,
			'top' => $top_ratt,
			);

		$this->load->view('meth',$view_data);
	}

	private function GetRecomentByRatting() {
		$data = $this->dsb->get_koleksi('koleksi_code,koleksi_ratting');
		foreach ($data as $value) {
			$ranks[$value->koleksi_code] = $value->koleksi_ratting;
		}
		return $ranks;
	}

	private function GetRecomentByAnggota($data,$user) {
		$total = array();
        $simSums = array();
        $ranks = array();
        $sim = 0;
        
        foreach($data as $anggota => $values) {
        	if($anggota != $user)
                $sim = $this->similarityDistance($data, $user, $anggota);
            
            if($sim > 0) {
                foreach($data[$anggota] as $koleksi_anggota => $nilai_koleksi) {
                    if(!array_key_exists($koleksi_anggota, $data[$user])) {
                        if(!array_key_exists($koleksi_anggota, $total))
                            $total[$koleksi_anggota] = 0;

                        $total[$koleksi_anggota] += $data[$anggota][$koleksi_anggota] * $sim;
                        
                        if(!array_key_exists($koleksi_anggota, $simSums))
                            $simSums[$koleksi_anggota] = 0;

                        $simSums[$koleksi_anggota] += $sim;
                    }
                }
            }
        }

        foreach($total as $judul => $value)
            $ranks[$judul] = $value / $simSums[$judul];
        
        return $ranks;
	}

	private function linkdata() {
		$this->init();
		$data = array();
	    $anggota = $this->dsb->get_anggota();

	    foreach ($anggota as $o_anggota) {
	    	$ratting = $this->dsb->get_ratting('*',array('anggota_key' => $o_anggota->anggota_code));
	    	foreach ($ratting as $o_ratting) {
	    		$koleksi = $this->dsb->get_koleksi('*',array('koleksi_code' => $o_ratting->koleksi_key));
	    		foreach ($koleksi as $o_koleksi) {
	    			$data[$o_anggota->anggota_code][$o_koleksi->koleksi_code]=$o_ratting->ratting_val;
	    		}
	    	}
	    }

	    return $data;
	}

	private function similarityDistance($data, $user, $anggota) {
		$this->init();
        $similar = array();
        $sum = 0;
    
        foreach($data[$user] as $judul => $value)
	        if(array_key_exists($judul, $data[$anggota]))
                $similar[$judul] = 1;
        
        if(count($similar) == 0)
            return 0;
        
        foreach($data[$user] as $judul => $value)
        	if(array_key_exists($judul, $data[$anggota]))
                $sum = $sum + pow($value - $data[$anggota][$judul], 2);

        // return  1/(1 + sqrt($sum));
        return  1/(1 + $sum);
    }

    private function check_isNull($data) {
    	$koleksi = $this->dsb->get_koleksi();
    	$userId = $this->session->id;
    	
    	$countBookUser = TRUE;
    	if (count($data[$userId]) == count($koleksi)) {
    		$countBookUser = FALSE;
    	}

    	$countBook = 0;
    	foreach ($data as $user => $book) {
    		if (count($data[$user]) == count($koleksi)) {
    			$countBook += 1;
    		}
    	}

    	if ($countBook==count($data) || !$countBookUser) {
    		return FALSE;
    	} else {
    		return TRUE;
    	}

    }

    public function updatepass() {
    	$this->init();
		$input = $this->input->post();

		$anggota = $this->dsb->get_anngota_once(array('anggota_code' => $this->session->id));
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
		
		if ($input['pass_old'] != $anggota->anggota_pass)
			$error[] = "Password sebelummnya tidak cocok";
		
		$is_error = $this->error($error);

		if ($is_error) {	
			redirect('/Dashboard/pengaturan');
		} else {
			$code = $anggota->anggota_code;
			$_data['anggota_pass'] = $input['pass_new'];
			$this->dsb->save_updateanggota($_data,$code);
			$this->success(array("Password berhasil diubah"));
			redirect('Dashboard/pengaturan');
		}
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

	public function downloadkoleksi() {
    	$this->init();

		$input = $this->input->post();

    	$koleksi = $this->kol->get_koleksi_once(array('koleksi_code' => $input['code']));

    	if (isset($koleksi)) {
    		$tes = force_download('./up_file/koleksi/'.$koleksi->koleksi_file.'.pdf',NULL);
    	}
    		
    }
}
