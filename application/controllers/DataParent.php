<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataParent extends CI_Controller {

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
		$data['getMenu']   	   = $this->menu_m->getMenu();
		$data['getParentMenu'] = $this->menu_m->getParentMenu();
		$this->load->view('managemenMenu/DataParent', $data);
	}

	public function tambahParent() {
		try {
			// $this->form_validation->set_rules('menuId', 'Menu Id', 'required|trim', [
	  //           'required' => 'Silahkan masukkan Menu !'
	  //       ]);
	        $this->form_validation->set_rules('namaParent', 'Parent Name', 'required|trim', [
	            'required' => 'Silahkan masukkan Parent Menu!'
	        ]);
	         $this->form_validation->set_rules('parentIcon', 'Parent Icon', 'required|trim', [
	            'required' => 'Silahkan masukkan Parent Icon!'
	        ]);

	        if($this->form_validation->run() == FALSE){
	            $this->load->view('managemenMenu/DataParent');
	        }else{
	        	$data = [
	        		// 'menu_id' 	      => htmlspecialchars($this->input->post('menuId', true)),
	        		'parent_name' 	  => htmlspecialchars($this->input->post('namaParent', true)),
	        		'parent_icon' 	  => htmlspecialchars($this->input->post('parentIcon', true)),
	                'created_by'      => "System",
	                'created_date'    => date("Y-m-d H:i:s"),
	                'updated_by'      => "System",
	                'created_date'    => date("Y-m-d H:i:s"),

	        	];

	        	$this->db->insert('parent_menu', $data);
	               
	        	$this->session->set_flashdata('massage','<div class="alert alert-success" role="alert">
	  			Menu Parent Berhasil Ditambahkan !</div>');
	        	redirect('DataParent');
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

			$data['getMenuById']   = $this->menu_m->getMenuById($id);
			$data['getParentById'] = $this->menu_m->getParentById();
			$this->load->view('managemenMenu/dataParent', $data);
			
		} catch (Exception $e) {
			var_dump($e->getMessage());
        	die();
	        log_message('error: ',$e->getMessage());
	        return;
		}
	}

	function editParent() {
		try {
			// $this->form_validation->set_rules('menuId', 'Menu Id', 'required|trim', [
	  //           'required' => 'Silahkan masukkan Menu !'
	  //       ]);
	        $this->form_validation->set_rules('namaParent', 'Parent Name', 'required|trim', [
	            'required' => 'Silahkan masukkan Parent Menu!'
	        ]);
	         $this->form_validation->set_rules('parentIcon', 'Parent Icon', 'required|trim', [
	            'required' => 'Silahkan masukkan Parent Icon!'
	        ]);

	        if($this->form_validation->run() == FALSE){
	            $this->load->view('managemenMenu/dataParent');
	        }else{
	        	$data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
	        	$data = array(
	        		// 'menu_id' 	      => htmlspecialchars($this->input->post('menuId', true)),
	        		'parent_name' 	  => htmlspecialchars($this->input->post('namaParent', true)),
	        		'parent_icon' 	  => htmlspecialchars($this->input->post('parentIcon', true)),
	                'updated_by'      => $data["user"]["username"],
	                'updated_date'    => date("Y-m-d H:i:s"),
	        	);

	        	$where = htmlspecialchars($this->input->post('idParent', true));
	        	$this->menu_m->editParent($where, $data);
	               
	        	$this->session->set_flashdata('massage','<div class="alert alert-info" role="alert">
	  			Menu Parent Berhasil Diedit !</div>');
	        	redirect('DataParent');
	        }
			
		} catch (Exception $e) {
			var_dump($e->getMessage());
        	die();
	        log_message('error: ',$e->getMessage());
	        return;
		}
	}

	function hapusParent() {
		try {
			$id =  htmlspecialchars($this->input->post('idParent', true));
			$this->menu_m->hapusParent($id);

			$this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">
	  		Menu Parent Berhasil Dihapus !</div>');
	        redirect('DataParent');
			
		} catch (Exception $e) {
			var_dump($e->getMessage());
        	die();
	        log_message('error: ',$e->getMessage());
	        return;
		}
	}
}
