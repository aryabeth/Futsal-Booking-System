<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Databarang extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_databarang');
	}

	public function index()
	{
		if (isset($this->session->userdata('user_data')['username'])) {
			$data['listbarang'] =$this->m_databarang->get_list_barang();
			$this->load->view('databarang',$data);
		}else{	
			redirect('login');
		}

	}
	
	function tambah(){
		$id_barang = $this->input->post('id_barang');
        $nama_barang = $this->input->post('nama_barang'); 
     	$hargabeli = $this->input->post('hargabeli');
     	$hargajual = $this->input->post('hargajual'); 
     	$stok = $this->input->post('stok'); 
     	$keterangan = $this->input->post('keterangan'); 
     	$status = 0;
     	$data = array(
			'id_barang' => $id_barang,
			'nama_barang' => $nama_barang,
			'harga_beli' => $hargabeli,
			'harga_jual' => $hargajual,
			'stok' => $stok,
			'keterangan' => $keterangan,
			'status' => $status,
		);
		$this->m_databarang->add_barang($data);
		redirect('databarang');
	}

	function ubah(){
		foreach ($_POST as $value) {
			$insert =  $value;
		}
		$this->m_databarang->update_list_barang($insert);
	}	
	
	function hapus($id){
		$this->m_databarang->hapus_barang($id);
	}

}

