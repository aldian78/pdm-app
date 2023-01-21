<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataMenu extends CI_Controller {

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
		$data['getMenu']  = $this->menu_m->getMenuWithLevel();
		$data['getLevel'] = $this->menu_m->getLevel();
		$data['getParentMenu'] = $this->menu_m->getParentMenu();
		$this->load->view('managemenMenu/DataMenu', $data);
	}

	public function tambahMenu() {
		try {
			$this->form_validation->set_rules('levelId', 'Level', 'required|trim', [
	            'required' => 'Silahkan masukkan Level !'
	        ]);
	        $this->form_validation->set_rules('menuName', 'Menu Name', 'required|trim', [
	            'required' => 'Silahkan masukkan Menu Name!'
	        ]);
	        $this->form_validation->set_rules('menuLink', 'Menu Link', 'required|trim', [
	            'required' => 'Silahkan masukkan Menu Link!'
	        ]);
	        $this->form_validation->set_rules('menuIcon', 'Menu Icon', 'required|trim', [
	            'required' => 'Silahkan masukkan Menu Icon!'
	        ]);
	        $this->form_validation->set_rules('parentId', 'Parent Name', 'required|trim', [
	            'required' => 'Silahkan masukkan Name Parent/Induk!'
	        ]);
	        $this->form_validation->set_rules('status', 'Status', 'required|trim', [
	            'required' => 'Silahkan masukkan Status!'
	        ]);

	        if($this->form_validation->run() == FALSE){
	            $this->load->view('managemenMenu/DataMenu');
	        }else{
	        	$data = [
	        		'id_level' 	      => htmlspecialchars($this->input->post('levelId', true)),
	        		'menu_name' 	  => htmlspecialchars($this->input->post('menuName', true)),
	        		'menu_link' 	  => htmlspecialchars($this->input->post('menuLink', true)),
	        		'menu_icon' 	  => htmlspecialchars($this->input->post('menuIcon', true)),
	        		'parent_id' 	  => htmlspecialchars($this->input->post('parentId', true)),
	        		'is_active' 	  => htmlspecialchars($this->input->post('status', true)),
	                'created_by'      => "System",
	                'created_date'    => date("Y-m-d H:i:s"),
	                'updated_by'      => "System",
	                'created_date'    => date("Y-m-d H:i:s"),

	        	];

	        	$this->db->insert('menu', $data);
	               
	        	$this->session->set_flashdata('massage','<div class="alert alert-success" role="alert">
	  			Menu Berhasil Ditambahkan !</div>');
	        	redirect('DataMenu');
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
			$this->load->view('managemenMenu/dataMenu', $data);
			
		} catch (Exception $e) {
			var_dump($e->getMessage());
        	die();
	        log_message('error: ',$e->getMessage());
	        return;
		}
	}

	function editMenu() {
		try {
			$this->form_validation->set_rules('levelId', 'Level', 'required|trim', [
	            'required' => 'Silahkan masukkan Level !'
	        ]);
	        $this->form_validation->set_rules('menuName', 'Menu Name', 'required|trim', [
	            'required' => 'Silahkan masukkan Menu Name!'
	        ]);
	        $this->form_validation->set_rules('menuLink', 'Menu Link', 'required|trim', [
	            'required' => 'Silahkan masukkan Menu Link!'
	        ]);
	        $this->form_validation->set_rules('menuIcon', 'Menu Icon', 'required|trim', [
	            'required' => 'Silahkan masukkan Menu Icon!'
	        ]);
	         $this->form_validation->set_rules('parentId', 'Nama Parent', 'required|trim', [
	            'required' => 'Silahkan masukkan Nama Parent!'
	        ]);
	        $this->form_validation->set_rules('status', 'Status', 'required|trim', [
	            'required' => 'Silahkan masukkan Status!'
	        ]);

	        if($this->form_validation->run() == FALSE){
	            $this->load->view('managemenMenu/dataMenu');
	        }else{
	        	$data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
	        	$data = array(
	        		'id_level' 	      => htmlspecialchars($this->input->post('levelId', true)),
	        		'menu_name' 	  => htmlspecialchars($this->input->post('menuName', true)),
	        		'menu_link' 	  => htmlspecialchars($this->input->post('menuLink', true)),
	        		'menu_icon' 	  => htmlspecialchars($this->input->post('menuIcon', true)),
	        		'parent_id' 	  => htmlspecialchars($this->input->post('parentId', true)),
	        		'is_active' 	  => htmlspecialchars($this->input->post('status', true)),
	                'updated_by'      => $data["user"]["username"],
	                'updated_date'    => date("Y-m-d H:i:s"),
	        	);

	        	$where = htmlspecialchars($this->input->post('idMenu', true));
	        	$this->menu_m->editMenu($where, $data);
	               
	        	$this->session->set_flashdata('massage','<div class="alert alert-info" role="alert">
	  			Menu Berhasil Diedit !</div>');
	        	redirect('DataMenu');
	        }
			
		} catch (Exception $e) {
			var_dump($e->getMessage());
        	die();
	        log_message('error: ',$e->getMessage());
	        return;
		}
	}

	function hapusMenu() {
		try {
			$id =  htmlspecialchars($this->input->post('idMenu', true));
			$this->menu_m->hapusMenu($id);

			$this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">
	  		Menu Berhasil Dihapus !</div>');
	        redirect('DataMenu');
			
		} catch (Exception $e) {
			var_dump($e->getMessage());
        	die();
	        log_message('error: ',$e->getMessage());
	        return;
		}
	}
}
