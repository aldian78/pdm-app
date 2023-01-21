<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataKaryawan extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('karyawan_m');
        $this->load->model('jabatan_m');
        $this->load->model('login_m');
    }

	public function index()
	{
		check_tidak_login(); // hak akses fungsi dihelper
		
		$data['user'] = $this->login_m->getUserById()->row_array();
		$data['getKaryawan'] = $this->karyawan_m->getKaryawan();
		$data['getJabatan'] = $this->jabatan_m->getJabatan();
		$this->load->view('dataKaryawan/DataKaryawan', $data);
	}

	public function tambahKaryawan() {
		try {
			$this->form_validation->set_rules('namaKaryawan', 'Nama Karyawan', 'required|trim', [
	            'required' => 'Silahkan masukkan Karyawan !'
	        ]);
	        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
	            'required' => 'Silahkan masukkan Alamat !'
	        ]);
	         $this->form_validation->set_rules('nik', 'NIK', 'required|trim', [
	            'required' => 'Silahkan masukkan No NIK !'
	        ]);
	        $this->form_validation->set_rules('status', 'Status', 'required|trim', [
	            'required' => 'Silahkan masukkan Status !'
	        ]);
	        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim', [
	            'required' => 'Silahkan masukkan Jabatan !'
	        ]);

	        if($this->form_validation->run() == FALSE){
	        	$data['getJabatan'] = $this->jabatan_m->getJabatan();
	            $this->load->view('dataKaryawan/tambahKaryawan', $data);
	        }else{
	        	$data = [
	        		'nama' 	  		  => htmlspecialchars($this->input->post('namaKaryawan', true)),
	        		'alamat'          => htmlspecialchars($this->input->post('alamat', true)),
	                'nik'			  => htmlspecialchars($this->input->post('nik', true)),
	                'status'          => htmlspecialchars($this->input->post('status', true)),
	                'jabatan'         => htmlspecialchars($this->input->post('jabatan', true)),
	                'created_by'      => "System",
	                'created_date'    => date("Y-m-d H:i:s"),
	                'updated_by'      => "System",
	                'created_date'    => date("Y-m-d H:i:s"),

	        	];

	        	$this->db->insert('karyawan', $data);
	               
	        	$this->session->set_flashdata('massage','<div class="alert alert-success" role="alert">
	  			 Karyawan Berhasil Ditambahkan !</div>');
	        	redirect('DataKaryawan');
	        }
        } catch (Exception $e) {
        	var_dump($e->getMessage());
        	die();
	        log_message('error: ',$e->getMessage());
	        return;
	    }
	}

	function getById($id) {
		try {

			$data['karyawan'] = $this->karyawan_m->getById($id);
			$data['getJabatan'] = $this->jabatan_m->getJabatan();
			$this->load->view('dataKaryawan/editKaryawan', $data);
			
		} catch (Exception $e) {
			var_dump($e->getMessage());
        	die();
	        log_message('error: ',$e->getMessage());
	        return;
		}
	}

	function editKaryawan() {
		try {
			$this->form_validation->set_rules('namaKaryawan', 'Nama Karyawan', 'required|trim', [
	            'required' => 'Silahkan masukkan Karyawan !'
	        ]);
	        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
	            'required' => 'Silahkan masukkan Alamat !'
	        ]);
	         $this->form_validation->set_rules('nik', 'NIK', 'required|trim', [
	            'required' => 'Silahkan masukkan No NIK !'
	        ]);
	        $this->form_validation->set_rules('status', 'Status', 'required|trim', [
	            'required' => 'Silahkan masukkan Status !'
	        ]);
	        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim', [
	            'required' => 'Silahkan masukkan Jabatan !'
	        ]);

	        if($this->form_validation->run() == FALSE){
	        	$data['getJabatan'] = $this->jabatan_m->getJabatan();
	            $this->load->view('dataKaryawan/editKaryawan', $data);
	        }else{
	        	$data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
	        	$data = array(
	        		'nama' 	  		  => htmlspecialchars($this->input->post('namaKaryawan', true)),
	        		'alamat'          => htmlspecialchars($this->input->post('alamat', true)),
	                'nik'			  => htmlspecialchars($this->input->post('nik', true)),
	                'status'          => htmlspecialchars($this->input->post('status', true)),
	                'jabatan'         => htmlspecialchars($this->input->post('jabatan', true)),
	                'updated_by'      => $data["user"]["username"],
	                'updated_date'    => date("Y-m-d H:i:s"),
	        	);

	        	$where = htmlspecialchars($this->input->post('idKaryawan', true));
	        	$this->karyawan_m->editKaryawan($where, $data);
	               
	        	$this->session->set_flashdata('massage','<div class="alert alert-info" role="alert">
	  			 Karyawan Berhasil Diedit !</div>');
	        	redirect('DataKaryawan');
	        }
			
		} catch (Exception $e) {
			var_dump($e->getMessage());
        	die();
	        log_message('error: ',$e->getMessage());
	        return;
		}
	}

	function hapusKaryawan() {
		try {
			$id =  htmlspecialchars($this->input->post('idKaryawan', true));
			$this->karyawan_m->hapusKaryawan($id);

			$this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">
	  		Karyawan Berhasil Dihapus !</div>');
	        redirect('DataKaryawan');
			
		} catch (Exception $e) {
			var_dump($e->getMessage());
        	die();
	        log_message('error: ',$e->getMessage());
	        return;
		}
	}
}
