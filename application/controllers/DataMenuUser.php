<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataMenuUser extends CI_Controller {

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
		$data['getMenuUser']   = $this->menu_m->getMenuUser();
		$data['getMenu']   = $this->menu_m->getMenu();
		$data['getParentMenu'] = $this->menu_m->getParentMenu();
		$data['getUser'] = $this->login_m->getUser();
		$this->load->view('managemenMenu/DataMenuUser', $data);
	}

	public function tambahMenuUser() {
		try {
			$this->form_validation->set_rules('user', 'User', 'required|trim', [
	            'required' => 'Silahkan masukkan User !'
	        ]);
	        $this->form_validation->set_rules('parent', 'Parent', 'required|trim', [
	            'required' => 'Silahkan masukkan Parent!'
	        ]);
	         $this->form_validation->set_rules('menuId', 'Menu ID', 'required|trim', [
	            'required' => 'Silahkan masukkan Sub Menu!'
	        ]);

	        if($this->form_validation->run() == FALSE){
	            $this->load->view('managemenMenu/dataMenuUser', $data);
	        }else{
	        	$data = [
	        		'id_user' 	      => htmlspecialchars($this->input->post('user', true)),
	        		'parent_id' 	  => htmlspecialchars($this->input->post('parent', true)),
	        		'menu_id' 	  => htmlspecialchars($this->input->post('menuId', true)),
	                'created_by'      => "System",
	                'created_date'    => date("Y-m-d H:i:s"),
	                'updated_by'      => "System",
	                'created_date'    => date("Y-m-d H:i:s"),

	        	];

	        	$this->db->insert('menu_user', $data);
	               
	        	$this->session->set_flashdata('massage','<div class="alert alert-success" role="alert">
	  			Menu User Berhasil Ditambahkan !</div>');
	        	redirect('DataMenuUser');
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
			$this->load->view('managemenMenu/dataMenuUser', $data);
			
		} catch (Exception $e) {
			var_dump($e->getMessage());
        	die();
	        log_message('error: ',$e->getMessage());
	        return;
		}
	}

	function editMenuUser() {
		try {
			$this->form_validation->set_rules('user', 'User', 'required|trim', [
	            'required' => 'Silahkan masukkan User !'
	        ]);
	        $this->form_validation->set_rules('parent', 'Parent', 'required|trim', [
	            'required' => 'Silahkan masukkan Parent!'
	        ]);
	         $this->form_validation->set_rules('menuId', 'Menu ID', 'required|trim', [
	            'required' => 'Silahkan masukkan Sub Menu!'
	        ]);

	        if($this->form_validation->run() == FALSE){
	            $this->load->view('managemenMenu/dataMenuUser', $data);
	        }else{
	        	$data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
	        	$data = array(
	        		'id_user' 	      => htmlspecialchars($this->input->post('user', true)),
	        		'parent_id' 	  => htmlspecialchars($this->input->post('parent', true)),
	        		'menu_id' 	  => htmlspecialchars($this->input->post('menuId', true)),
	                'updated_by'      => $data["user"]["username"],
	                'updated_date'    => date("Y-m-d H:i:s"),
	        	);

	        	$where = htmlspecialchars($this->input->post('idMenuUser', true));
	        	$this->menu_m->editMenuUser($where, $data);
	               
	        	$this->session->set_flashdata('massage','<div class="alert alert-info" role="alert">
	  			Menu User Berhasil Diedit !</div>');
	        	redirect('DataMenuUser');
	        }
			
		} catch (Exception $e) {
			var_dump($e->getMessage());
        	die();
	        log_message('error: ',$e->getMessage());
	        return;
		}
	}

	function hapusMenuUser() {
		try {
			$id =  htmlspecialchars($this->input->post('idMenuUser', true));
			$this->menu_m->hapusMenuUser($id);

			$this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">
	  		Menu User Berhasil Dihapus !</div>');
	        redirect('DataMenuUser');
			
		} catch (Exception $e) {
			var_dump($e->getMessage());
        	die();
	        log_message('error: ',$e->getMessage());
	        return;
		}
	}
}
