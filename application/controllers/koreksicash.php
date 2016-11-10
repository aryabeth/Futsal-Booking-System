<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Koreksicash extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_koreksi');
		$this->load->model('m_override_pengguna','override_pengguna');
	}

	public function index()
	{
		if (isset($this->session->userdata('user_data')['username'])) {
			$year_now = date('Y');
			$month_now = date('m');
			$nota = $this->m_koreksi->create_nota_cash($year_now, $month_now);
			$data['id_nota'] = 'KC-'.$nota.'';
			$data['listkoreksi'] =$this->m_koreksi->get_list_koreksi_cash();
			
			$this->load->view('koreksicash', $data);	
		}else{
			redirect('login');
		}
	}

	function get_master_barang(){
		$result = $this->m_koreksi->get_list_barang();
		header('Content-Type: application/json');
    	echo json_encode($result);
	}

	function tambah(){
		$id_nota = $this->input->post('id_nota');
		$transaksi = $this->input->post('korekTransaksi');
		$tgl_jual = $this->input->post('tgl_waktu');
        $jml = $this->input->post('jumlah');
     	$operator = $this->session->userdata('user_data')['username'];
		$override = $this->input->post('override');
     	$keterangan = $this->input->post('ket'); 
     	$status = 0;
     	$data = array(
     		'id_nota' => $id_nota,
     		'transaksi' => $transaksi,
			'tanggal_koreksi' => $tgl_jual,
			'jumlah' => $jml,
			'keterangan' => $keterangan,
			'operator' => $operator,
			'override' => $override,
			'status' => $status
		);


		$this->m_koreksi->add_koreksi_cash($data);
		redirect('koreksicash');
	}

}

