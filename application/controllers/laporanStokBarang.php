<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporanStokBarang extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_laporan_stok_barang');
	}

	public function index()
	{
		if (isset($this->session->userdata('user_data')['username'])) {
			$this->load->view('laporanstokbarang');
		}else{	
			redirect('login');
		}

	}

	public function get_laporan($bulan){
		$laporan = $this->m_laporan_stok_barang->get_laporan_now($bulan);
		header('Content-Type: application/json');
	 	echo json_encode($laporan);
	}
	
}

