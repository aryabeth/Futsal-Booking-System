<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_login');
	}

	public function index()
	{	
		if (isset($this->user) && !empty($this->user)) {
			redirect('home');
		}

		$this->get_user_login();
		$this->load->view('login');
	}

	protected function get_user_login() {
		// get user login
		if (!isset($this->session->userdata('user_data')['username'])) {
			
		}else{	
			redirect('home');
		}
	}

	function login_process(){
		$query = $this->m_login->login_validation();
		$username = $this->input->post('username');
        if ($query) {
        	$user = $this->m_login->get_user($username);
        	// print_r($user);
        	$user_data = array(
        		"user_id" => $user[0]->user_id,
        		"name" => $user[0]->name,
        		"username" => $user[0]->username,
        		"password" => $user[0]->password,
        		"level" => $user[0]->level
        	);	
        	$this->session->set_userdata('user_data', $user_data);
        	redirect('home');

        }else{
			redirect('login');        	
        }
	}
	
	// logout
	public function logout() {
		
		$this->session->unset_userdata('user_data');
		redirect('login');

	}
}

