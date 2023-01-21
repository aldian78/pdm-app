<?php
class Login extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('login_m');
     }

    public function index()
    {

        check_sudah_login(); // hak akses fungsi dihelper
        
        $data['title'] = "Login";
        $this->load->view('login', $data);
    }

    public function process ()
    {
    	// yuk koding media
        $this->form_validation->set_rules('email', 'Email', 'required|trim', [
            'required' => 'Email harus diisi !'
        ]);
        $this->form_validation->set_rules('password', 'Password Confirmation', 'required', [
            'required' => 'Password harus diisi !'
        ]);

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = "Login";
            $this->load->view('login', $data);
        }else{
            $post = $this->input->post(null, true);
            if(isset($post['login'])){
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $this->load->model('login_m');
                $query = $this->login_m->login($post);
                if($query->num_rows() > 0){
                    $row = $query->row();
                    if($row->id_jenis_user == 1){
                        $params = array(
                        'id_user' => $row->id_user,
                        'status'  => $row->status_user,
                        'access'  => "Administrator"
                        );
                        $this->session->set_userdata($params);
                        redirect('Dashboard');
                    }elseif($row->id_jenis_user==2){
                         $params = array(
                            'id_user' => $row->id_user,
                            'status'  => $row->status_user,
                            'access'  => "HRD"
                        );
                        $this->session->set_userdata($params);
                        redirect('Dashboard');
                    }else{
                        $params = array(
                            'id_user' => $row->id_user,
                            'status' => $row->status_user,
                            'access'  => "Staff"
                        );
                        $this->session->set_userdata($params);
                        redirect('Dashboard');
                    }
                }else{
                    $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">
                    Login gagal ! Pastikan Email dan Password anda benar ! </div>');
                    redirect('login');
                }
            }
        }
    }

  

    public function register()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Silahkan masukkan Nama !'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
        	'is_unique' => 'Email sudah pernah dipakai !',
            'required' => 'Silahkan masukkan Email !'
        ]);
         $this->form_validation->set_rules('noHP', 'No Handphone', 'required|trim', [
            'required' => 'Silahkan masukkan No Handphone !'
        ]);
        $this->form_validation->set_rules('noWa', 'No Whattsapp', 'required|trim', [
            'required' => 'Silahkan masukkan No Whattsapp !'
        ]);
        $this->form_validation->set_rules('pin', 'PIN', 'required|trim', [
            'required' => 'Silahkan masukkan PIN !'
        ]);
		$this->form_validation->set_rules('password1', 'Password1', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'Kata sandi tidak cocok!',
			'min_length' => 'Kata sandi terlalu pendek !',
            'required' => 'Silahkan masukan Password !'
		]);
		$this->form_validation->set_rules('password2', 'Password2', 'required|trim|matches[password1]',[
                'required' => 'Silahkan masukan Password Confrim !'
        ]);

        if($this->form_validation->run() == FALSE){

        	$data['title'] = "Register";
            $this->load->view('register', $data);
        }else{
        	$data = [
        		'nama_user' 	  => htmlspecialchars($this->input->post('nama', true)),
        		'username'        => htmlspecialchars($this->input->post('nama', true)),
                'email'			  => htmlspecialchars($this->input->post('email', true)),
                'no_hp'           => htmlspecialchars($this->input->post('noHP', true)),
                'wa'              => htmlspecialchars($this->input->post('noWa', true)),
                'pin'             => htmlspecialchars($this->input->post('pin', true)),
        		// 'gambar' 		=> 'default.jpg',
        		'password' 		  => sha1($this->input->post('password1')),
        		'id_jenis_user'   => 1, //defaultnya administrator
                'status_user'     => "Active",
                'delete_mark'     => "N",
                'created_by'      => "System",
                'created_date'    => date("Y-m-d H:i:s"),
                'updated_by'      => "System",
                'created_date'    => date("Y-m-d H:i:s"),

        	];


        	$getId = $this->login_m->register($data);
            
            $userFoto = [ 
                'id_user'         => $getId,
                'foto'            => "default.jpg",
                'created_by'      => "System",
                'created_date'    => date("Y-m-d H:i:s"),
                'deleted_mark'    => 'N',
                'updated_by'      => "System",
                'created_date'    => date("Y-m-d H:i:s"),
            ];
            
            $this->login_m->user_foto($userFoto);

        	$this->session->set_flashdata('massage','<div class="alert alert-success" role="alert">
  			Register success ! Silahkan login </div>');
        	redirect('login/register');
        }
    }
        
    public function logout()
    {
        $params = array('id_user', 'status');
        $this->session->unset_userdata($params);

      	$this->session->set_flashdata('massage','<div class="alert alert-success" role="alert">
		Berhasil logout </div>');
		redirect('login');
    }

    public function forgot_password()
    {

        //web programming unpas
             
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Silahkan masukkan Email !'
        ]); 

        if($this->form_validation->run() == FALSE){

            $data['title'] = "Forgot password";
            $this->load->view('admin/forgot_password', $data);
        }else{
            
            $email  = $this->input->post('email');
            $user   = $this->db->get_where('user', ['email' => $email])->row_array(); 

            if($user){
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token
                ];

            $this->db->insert('user_token', $user_token);
            $this->_sendemail($token, 'forgot_password');
            $this->session->set_flashdata('massage','<div class="alert alert-success" role="alert">
            Silahkan check email untuk reset password</div>');
            redirect('admin/login/forgot_password');

            }else{
                
            $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">
            Email belum terdaftar ! </div>');
            redirect('admin/login/forgot_password');
            }
        }
    }
    
    private function _sendemail($token, $type){
        
        $this->load->library('email');  
  
        $config = array();  
        $config['protocol'] = 'smtp';  
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';  
        $config['smtp_user'] = 'anisaflorasidoarjo@gmail.com';  
        $config['smtp_pass'] = '@anisa123';  
        $config['smtp_port'] = 465;
        $config['mailtype'] = 'html';    
        $config['charset'] = 'utf-8'; 
        $config['newline'] = "\r\n";  

        $this->email->initialize($config);  
  

        $this->email->from('anisaflorasidoarjo@gmail.com', 'Anisa Flora Sidoarjo');
        $this->email->to($this->input->post('email'));
        if($type == 'forgot_password'){
            $this->email->subject('Reset Password');
            $this->email->message('Klik link untuk reset password : <a href="' . base_url() . 'admin/login/reset_password?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"> Reset Password </a>');
        }
       if( $this->email->send()){
            return true;
       }else{
        echo $this->email->print_debugger();
        die;
       }
    }

    public function reset_password()
    {
        //web programming unpas
        $email = $this->input->get('email');
        $token = $this->input->get('token');    

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if($user)
        {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if($user_token){

                $this->session->set_userdata('reset_email', $email);
                $this->change_password();

            }else{

            $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">
            Reset password gagal ! token salah </div>');
            redirect('admin/login/forgot_password');
            }

        }else{

            $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">
            Reset password gagal ! Email salah </div>');
            redirect('admin/login/forgot_password');
        }
    }

    public function change_password()
    {
        //web programming unpas
        if(!$this->session->userdata('reset_email')){
            redirect('admin/login');
        }
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
                'required' => 'Silahkan masukkan Password !',
                'min_length' => 'Kata sandi terlalu pendek !',
                'matches' => 'Kata sandi tidak cocok !'
            ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]', [
                'required' => 'Silahkan masukkan Password !',
                'min_length' => 'Kata sandi terlalu pendek !',
                'matches' => 'Kata sandi tidak cocok !'
            ]);
        
        if($this->form_validation->run() == FALSE){

        $data['title'] = "Change password";
        $this->load->view('admin/change_password', $data);
        
        }else{

            $password = sha1($this->input->post('password1'));
            $email = $this->session->userdata('reset_email');

            $data = array(

            'password' => $password

            );

            $where = array(
                'email' => $email
            );

            $this->login_m->change_password($where, $data, 'user');

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('massage','<div class="alert alert-success" role="alert">
            Password telah diganti ! silahkan login </div>');
            redirect('admin/login');
        }
    }

}