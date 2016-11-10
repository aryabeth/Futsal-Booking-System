<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tdeposit extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_transaksi_deposit');
	}

	public function index()
	{
		$array = $this->m_transaksi_deposit->get_data_transaksi();
		$array['deposit'] = $array;
		$this->session->unset_userdata('override');
		$this->load->view('tdeposit', $array);
	}

	public function get_master_customer(){
		if ($this->session->userdata('user_data') == "") {
			redirect('home');
		}

		$result = $this->m_transaksi_deposit->get_list_customer();
		header('Content-Type: application/json');
    	echo json_encode($result);
	}

	public function simpan_transaksi(){
		if ($this->session->userdata('user_data') == "") {
			redirect('home');
		}

		if(null != $this->input->post("override")){
			$bonus = $this->input->post("jml_bonus");
			$ovr = $this->input->post("override");
			$saldo_akhir = $this->input->post("saldo_akhir");
		}else{
			$bonus = $this->input->post("jml_deposit")/10;
			$ovr = "";
			$saldo_akhir = $this->input->post("jml_deposit")+$bonus+$this->input->post("saldo_awal");			
		}		

		$array_nota = array(
			"tgl_deposit" => date('Y-m-d', strtotime($this->input->post('tgl_deposit'))),
			"id_customer" => $this->input->post("id_customer"),
			"jml_deposit" => $this->input->post("jml_deposit"),
			"jml_bonus" => $bonus,
			"saldo_awal" => $this->input->post("saldo_awal"),
			"saldo_akhir" => $saldo_akhir,
			"keterangan" => $this->input->post("keterangan"),
			"override" => $ovr,
			"id_operator" => $this->session->userdata('user_data')['user_id']
		);

		$query = $this->m_transaksi_deposit->simpan_transaksi($array_nota);
		if($query){
			redirect("tdeposit");
		}
	}

	public function batal_transaksi($id, $id_customer){
		if ($this->session->userdata('user_data') == "") {
			redirect('home');
		}

		$result = $this->m_transaksi_deposit->batal_transaksi($id, $id_customer);
		if($result == true){
			redirect('tdeposit');
		}else{
			return false;
		}
	}

	public function cek_password_customer($id_customer, $password){
		return $this->m_transaksi_deposit->cek_password_customer($id_customer, $password);
	}

	public function save_password_customer($id_customer, $password){
		$result = $this->m_transaksi_deposit->save_password_customer($id_customer, $password);
	}

	public function save_password_new_customer($id_customer, $password){
		$result = $this->m_transaksi_deposit->save_password_customer($id_customer, $password);
	}
}

