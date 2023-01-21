<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataJabatan extends CI_Controller {

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
		$this->load->view('dataJabatan/dataJabatan', $data);
	}

	public function tambahJabatan() {
		try {
			$this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim', [
	            'required' => 'Silahkan masukkan Jabatan !'
	        ]);

	        if($this->form_validation->run() == FALSE){
	        	$data['getJabatan'] = $this->jabatan_m->getJabatan();
	            $this->load->view('dataJabatan/dataJabatan', $data);
	        }else{
	        	$data = [
	        		'nama_jabatan' 	  => htmlspecialchars($this->input->post('jabatan', true)),
	                'created_by'      => "System",
	                'created_date'    => date("Y-m-d H:i:s"),
	                'updated_by'      => "System",
	                'created_date'    => date("Y-m-d H:i:s"),

	        	];

	        	$this->db->insert('jabatan', $data);
	               
	        	$this->session->set_flashdata('massage','<div class="alert alert-success" role="alert">
	  			Jabatan Berhasil Ditambahkan !</div>');
	        	redirect('DataJabatan');
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
			$this->load->view('dataJabatan/editJabatan', $data);
			
		} catch (Exception $e) {
			var_dump($e->getMessage());
        	die();
	        log_message('error: ',$e->getMessage());
	        return;
		}
	}

	function editJabatan() {
		try {
			$this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim', [
	            'required' => 'Silahkan masukkan Jabatan !'
	        ]);

	        if($this->form_validation->run() == FALSE){
	        	$data['getJabatan'] = $this->jabatan_m->getJabatan();
	            $this->load->view('dataJabatan/dataJabatan', $data);
	        }else{
	        	$data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
	        	$data = array(
	        		'nama_jabatan' 	  => htmlspecialchars($this->input->post('jabatan', true)),
	                'updated_by'      => $data["user"]["username"],
	                'updated_date'    => date("Y-m-d H:i:s"),
	        	);

	        	$where = htmlspecialchars($this->input->post('idJabatan', true));
	        	$this->jabatan_m->editJabatan($where, $data);
	               
	        	$this->session->set_flashdata('massage','<div class="alert alert-info" role="alert">
	  			Jabatan Berhasil Diedit !</div>');
	        	redirect('DataJabatan');
	        }
			
		} catch (Exception $e) {
			var_dump($e->getMessage());
        	die();
	        log_message('error: ',$e->getMessage());
	        return;
		}
	}

	function hapusJabatan() {
		try {
			$id =  htmlspecialchars($this->input->post('idJabatan', true));
			$this->jabatan_m->hapusJabatan($id);

			$this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">
	  		Jabatan Berhasil Dihapus !</div>');
	        redirect('DataJabatan');
			
		} catch (Exception $e) {
			var_dump($e->getMessage());
        	die();
	        log_message('error: ',$e->getMessage());
	        return;
		}
	}
}
