<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Koreksibarang extends CI_Controller {

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
			$nota = $this->m_koreksi->create_nota_barang($year_now, $month_now);
			$data['id_nota'] = 'KB-'.$nota.'';
			$data['listkoreksi'] =$this->m_koreksi->get_list_koreksi_barang();
			
			$this->load->view('koreksibarang',$data);	
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
		$tgl_jual = $this->input->post('tgl_waktu');
        $kode = $this->input->post('kode');
     	$namaBarang = $this->input->post('namaBarang'); 
     	$jml = $this->input->post('jumlah');
     	$operator = $this->session->userdata('user_data')['username'];
		$override = $this->input->post('override');
     	$keterangan = $this->input->post('ket'); 
     	$status = 0;
     	$data = array(
     		'id_nota' => $id_nota,
			'tanggal_koreksi' => $tgl_jual,
			'nama_barang' => $namaBarang,
			'kode_barang' => $kode,
			'jumlah' => $jml,
			'keterangan' => $keterangan,
			'operator' => $operator,
			'override' => $override,
			'status' => $status
		);


		$this->m_koreksi->add_koreksi_barang($data);
		redirect('koreksibarang');
	}

	

}

