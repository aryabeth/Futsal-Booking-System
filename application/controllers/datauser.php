<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datauser extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_datauser');
	}

	public function index()
	{
		if (isset($this->session->userdata('user_data')['username'])) {
			$data['listuser'] =$this->m_datauser->get_list_user();
			$this->load->view('datauser', $data);
		}else{
			redirect('login');
		}

	}
	
	function tambah_user(){
		$name = $this->input->post('name');
        $username = $this->input->post('username'); 
     	$password = $this->input->post('password');
     	$level = 3;
     	$status = 0;
     	$data = array(
			'name' => $name,
			'username' => $username,
			'password' => md5($password),
			'level' => $level,
			'status' => $status,
		);
		$this->m_datauser->add_user($data);
		redirect('datauser');
	}

	function ubah_password(){
		foreach ($_POST as $value) {
			$insert =  $value;
		}
		$this->m_datauser->update_pass($insert);
	}	

}

