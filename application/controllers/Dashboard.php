<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('login_m');
    }


	public function index()
	{
		check_tidak_login(); // hak akses fungsi dihelper
		
		$data['user'] = $this->login_m->getUserById()->row_array();
		$this->load->view('dashboard', $data);
	}
}
