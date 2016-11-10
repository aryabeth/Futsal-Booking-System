<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barangpenjualan extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_penjualan');
		$this->load->model('m_override_pengguna','override_pengguna');
	}

	public function index()
	{
		if (isset($this->session->userdata('user_data')['username'])) {
			$year_now = date('Y');
			$month_now = date('m');
			$nota = $this->m_penjualan->create_nota($year_now, $month_now);
			$data['id_nota'] = 'PJ-'.$nota.'';
			$data['listpenjualan'] =$this->m_penjualan->get_list_penjualan();
			$this->load->helper('url');
			$this->load->view('barangpenjualan',$data);
		}else{	
			redirect('login');
		}
	}
	
	function tambah(){
		$id_nota = $this->input->post('id_nota');
		$tgl_jual = $this->input->post('tgl_waktu');
        $kode = $this->input->post('kode');
        $namaBarang = $this->input->post('namaBarang');
     	$harga_jual = $this->input->post('harga'); 
     	$jml = $this->input->post('jumlah'); 
     	$disc = $this->input->post('disc'); 
     	$keterangan = $this->input->post('ket'); 
     	$id_operator = $this->input->post('user_id'); 
     	$status = 'NEW';
     	$data = array(
     		'id_nota' => $id_nota,
			'tgl_jual' => $tgl_jual,
			'id_barang' => $kode,
			'nama' => $namaBarang,
			'harga_jual' => $harga_jual,
			'jml' => $jml,
			'disc' => $disc,
			'keterangan' => $keterangan,
			'id_operator' => $id_operator,
			'status' => $status
		);

		// $data['id_nota'] = $this->m_penjualan->create_nota($year_now, $month_now);

		$this->m_penjualan->add_penjualan($data);
		$this->m_penjualan->update_stock($kode, $jml);
		redirect('barangpenjualan');
	}

	function hapus($id){

		$this->m_penjualan->hapus_penjualan($id);
	}

	function get_master_barang(){
		$result = $this->m_penjualan->get_list_barang();
		header('Content-Type: application/json');
    	echo json_encode($result);
	}

	public function ajax_override_pengguna()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // early validation
        if($username == '') {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'required';
            $data['status'] = FALSE;
        }

        if($password == '') {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'required';
            $data['status'] = FALSE;
        }


        if($data['status'] === FALSE) {
            echo json_encode($data);
        }
        else {
            echo json_encode($this->override_pengguna->user_check($username, $password));
        }
    }
}


