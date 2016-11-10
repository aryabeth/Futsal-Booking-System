<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tes extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_penjualan');
	}

	public function index()
	{
		if (isset($this->session->userdata('user_data')['username'])) {
			$this->load->helper('url');
			$this->load->view('tes');
		}else{	
			redirect('login');
		}
	}

	function get_master_barang(){
		$result = $this->m_penjualan->get_list_barang();
		header('Content-Type: application/json');
    	echo json_encode($result);
	}
}