<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataLevel extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('menu_m');
        $this->load->model('login_m');
    }

	public function index()
	{
		check_tidak_login(); // hak akses fungsi dihelper
		
		$data['user'] = $this->login_m->getUserById()->row_array();
		$data['getLevel'] = $this->menu_m->getLevel();
		$this->load->view('managemenMenu/DataLevel', $data);
	}

	public function tambahLevel() {
		try {
			$this->form_validation->set_rules('level', 'Level', 'required|trim', [
	            'required' => 'Silahkan masukkan Level !'
	        ]);

	        if($this->form_validation->run() == FALSE){
	            $this->load->view('managemenMenu/dataLevel');
	        }else{
	        	$data = [
	        		'level' 	      => htmlspecialchars($this->input->post('level', true)),
	                'created_by'      => "System",
	                'created_date'    => date("Y-m-d H:i:s"),
	                'updated_by'      => "System",
	                'created_date'    => date("Y-m-d H:i:s"),

	        	];

	        	$this->db->insert('menu_level', $data);
	               
	        	$this->session->set_flashdata('massage','<div class="alert alert-success" role="alert">
	  			Menu Level Berhasil Ditambahkan !</div>');
	        	redirect('DataLevel');
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

			$data['getUserById']   = $this->login_m->getUserById($id);
			$data['getParentById'] = $this->menu_m->getParentById();
			$this->load->view('managemenMenu/dataLevel', $data);
			
		} catch (Exception $e) {
			var_dump($e->getMessage());
        	die();
	        log_message('error: ',$e->getMessage());
	        return;
		}
	}

	function editLevel() {
		try {
			$this->form_validation->set_rules('level', 'Level', 'required|trim', [
	            'required' => 'Silahkan masukkan Level !'
	        ]);

	        if($this->form_validation->run() == FALSE){
	            $this->load->view('managemenMenu/dataLevell');
	        }else{
	        	$data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
	        	$data = array(
	        		'level' 	      => htmlspecialchars($this->input->post('level', true)),
	                'updated_by'      => $data["user"]["username"],
	                'updated_date'    => date("Y-m-d H:i:s"),
	        	);

	        	$where = htmlspecialchars($this->input->post('idLevel', true));
	        	$this->menu_m->editLevel($where, $data);
	               
	        	$this->session->set_flashdata('massage','<div class="alert alert-info" role="alert">
	  			Menu Level Berhasil Diedit !</div>');
	        	redirect('DataLevel');
	        }
			
		} catch (Exception $e) {
			var_dump($e->getMessage());
        	die();
	        log_message('error: ',$e->getMessage());
	        return;
		}
	}

	function hapusLevel() {
		try {
			$id =  htmlspecialchars($this->input->post('idLevel', true));
			$this->menu_m->hapusLevel($id);

			$this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">
	  		Menu Level Berhasil Dihapus !</div>');
	        redirect('DataLevel');
			
		} catch (Exception $e) {
			var_dump($e->getMessage());
        	die();
	        log_message('error: ',$e->getMessage());
	        return;
		}
	}
}
