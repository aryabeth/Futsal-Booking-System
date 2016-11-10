<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barangpembelian extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_pembelian');
		$this->load->model('m_override_pengguna','override_pengguna');
	}

	public function index(){
		$user = $this->session->userdata('user_data')['user_id'];
		if ($this->session->userdata('user_data')['username']) {
			$year_now = date('Y');
			$month_now = date('m');
			$nota = $this->m_pembelian->create_nota($year_now, $month_now);
			$data['id_nota'] = $nota;
			$data['listtemp'] = $this->m_pembelian->get_list_temp($user);
			$data['listnota'] =$this->m_pembelian->get_list_nota();
			$this->load->helper('url');
			$this->load->view('barangpembelian',$data);
		}else{	
			redirect('login');
		}

	}

	public function get_nota_details($id){
		$details = $this->m_pembelian->get_list_detail_nota($id);
		header('Content-Type: application/json');
	 	echo json_encode($details);
	}

	public function get_hutang_nota($id){
		$details = $this->m_pembelian->get_bayar_hutang($id);
		header('Content-Type: application/json');
	 	echo json_encode($details);
	}

	public function bayarhutang(){
		$tangal = $this->input->post('tgl_waktu');
		$nota = $this->input->post('notabayar');
		$nota_bayar = $this->m_pembelian->create_nota_bayar($nota);
		$bayar = $this->input->post('debet');
		$keterangan = $this->input->post('ketbayar');
		$operator = $this->input->post('operator');
		$override = $this->input->post('override');
		$status = 0;
		$bayar = array(
			'tanggal' => $tangal,
			'nota' => $nota,
			'nota_bayar' => $nota_bayar,
			'bayar' => $bayar,
			'keterangan' => $keterangan,
			'operator' => $operator,
			'override' => $override,
			'status' => $status
		);
		print_r($bayar);
		$this->m_pembelian->bayar_hutang($bayar);
		redirect('barangpembelian');
	}

	public function submitpembelian(){
		$not = $this->input->post('nota_pembelian');
        $tanggal_pembelian = $this->input->post('tgl_waktu'); 
     	$keterangan = $this->input->post('keterangan');
     	$operator = $this->input->post('operator'); 
     	$override = $this->input->post('override'); 
     	$tunai = $this->input->post('tunai-id'); 
     	$discbelitotal = $this->input->post('totDisc'); 
     	$jmlitem = $this->input->post('totJumlah'); 
     	$grosstotal = $this->input->post('subTotal'); 
     	$status = 0;
		$notabayar = $this->m_pembelian->create_nota_bayar($not);
		if ($tunai==1) {
			$bayar = $grosstotal;
		}else{
			$bayar = 0;
		}

     	$nota = array(
			'tanggal' => $tanggal_pembelian,
			'nota' => $not,
			'keterangan' => $keterangan,
			'discbelitotal' => $discbelitotal,
			'jmlitem' => $jmlitem,
			'grosstotal' => $grosstotal,
			'operator' => $operator,
			'override' => $override,
			'status' => $tunai
		);

		$pembelian = array(
			'tanggal_pembelian' => $tanggal_pembelian,
			'nota' => $not,
			'operator' => $operator,
			'override' => $override,
			'status' => $status
		);
			
		$nota_bayar = array(
			'tanggal' => $tanggal_pembelian,
			'nota' => $not,
			'nota_bayar' => $notabayar,
			'bayar' => $bayar,
			'keterangan' => '',
			'operator' => $operator,
			'override' => $override,
			'status' => $status,
		);

		$user = $this->session->userdata('user_data')['user_id'];
		$this->m_pembelian->add_pembelian($pembelian, $user);
		$this->m_pembelian->add_nota_pembelian($nota);
		$this->m_pembelian->add_nota_bayar($nota_bayar);
			
		redirect('barangpembelian');
     		
	}
	
	public function tambah_temp_pembelian(){
		foreach ($_POST as $value) {
			$insert =  $value;
		}
		$this->m_pembelian->add_temp($insert);
	}

	public function tambah_nota_bayar(){
		foreach ($_POST as $value) {
			$insert = $value;
		}
		$this->m_pembelian->add_nota_pembelian($insert);
	}

	public function tambah_pembelian(){
		foreach ($_POST as $value) {
			$insert = $value;
		}
		// $user = $this->session->userdata('user_data')['user_id'];
		$this->m_pembelian->add_pembelian($insert);
	}

	public function hapus_temp($id){
		$this->m_pembelian->hapus_temp($id);
	}

	public function reset(){
		$user = $this->session->userdata('user_data')['user_id'];
		$this->m_pembelian->reset($user);
	}

	public function get_master_barang(){
		$result = $this->m_pembelian->get_list_barang();
		header('Content-Type: application/json');
    	echo json_encode($result);
	}	

	public function ajax_override_pengguna(){
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

