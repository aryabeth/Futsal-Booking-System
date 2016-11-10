<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tlapangan extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_transaksi_lapangan');
	}

	public function index()
	{
		if (!isset($this->session->userdata('user_data')['username'])) {
			redirect('home');
		}
		$array = $this->m_transaksi_lapangan->get_data_transaksi();
		$array['nota'] = $array;
		$this->session->unset_userdata('override');
		$this->load->view('tlapangan', $array);
	}

	public function decimalHours($time)
	{
	    $hms = explode(":", $time);
	    return ($hms[0] + ($hms[1]/60));
	}

	public function get_master_customer(){
		$result = $this->m_transaksi_lapangan->get_list_customer();
		header('Content-Type: application/json');
    	echo json_encode($result);
	}

	public function search_nama_customer($nama){
		$result = $this->m_transaksi_lapangan->search_nama_customer($nama);
        $tamp = array();
        foreach ($result as $key => $value) {
            array_push($tamp, $value["nama"]);
        }
        $temp = array(
            "query" => "Unit",
            "suggestions" => $tamp);
        return json_encode($temp);
	}

	//Ancur
	public function simpan_transaksi_lunas(){
		if ($this->session->userdata('user_data') == "") {
			redirect('home');
		}

		//echo "aaaa"; die;

		$jml_jam = $this->decimalHours($this->input->post('jam_selesai')) - $this->decimalHours($this->input->post('jam_mulai'));

		$array_customer = array(
			"nama" => $this->input->post('nama'),
			"telp" => $this->input->post('telp'),
			"jml_jam" => $jml_jam,
			"jml_transaksi" => 1,
			"main_terakhir" => date('Y-m-d', strtotime($this->input->post('tgl_main'))));

		$query = $this->m_transaksi_lapangan->simpan_customer($array_customer);

		$diskon = 0;
		$override = "";
		$total_bayar = $this->input->post('total_bayar');
		$bayar_lunas = $this->input->post('bayar_lunas');

		if(null != $this->input->post('override') || "" != $this->input->post('override')){
			$override = $this->input->post('override');
			$diskon = $this->input->post('diskon');
		} else{
			if($this->input->post('diskon') != 0){
				$total_bayar += $this->input->post('diskon');
				$bayar_lunas += $this->input->post('diskon');
			}
			$diskon = 0;
		}

		$array_nota = array(
			"bayar_lunas" => $this->input->post('bayar_lunas'),
			"tgl_lunas" => date('Y-m-d', strtotime($this->input->post('tgl_lunas'))),
			"lapangan" => $this->input->post('lapangan'),
			"tgl_main" => date('Y-m-d', strtotime($this->input->post('tgl_main'))),
			"jam_mulai" => $this->input->post('jam_mulai'),
			"jam_selesai" => $this->input->post('jam_selesai'),
			"total_bayar" => $total_bayar,
			"id_customer" => $this->input->post('telp'),
			"diskon" => $diskon,
			"bonus" => $this->input->post('bonus'),
			"keterangan" => $this->input->post('keterangan'),
			"override" => $override,
			"id_operator" => $this->session->userdata('user_data')['user_id'],
			"status" => "LUNAS"
		);
	
		if($query){
			$query = $this->m_transaksi_lapangan->simpan_transaksi($array_nota);
		}else{
			redirect('tlapangan');
		}
		redirect('tlapangan');		
	}

	public function simpan_transaksi_dp(){
		//echo $this->input->post('total_bayar'); die;
		if ($this->session->userdata('user_data') == "") {
			redirect('home');
		}
		//print_r($this->input->post()); die;		

		$jml_jam = $this->decimalHours($this->input->post('jam_selesai')) - $this->decimalHours($this->input->post('jam_mulai'));

		$array_customer = array(
			"nama" => $this->input->post('nama'),
			"telp" => $this->input->post('telp'),
			"jml_jam" => $jml_jam,
			"jml_transaksi" => 1,
			"main_terakhir" => date('Y-m-d', strtotime($this->input->post('tgl_main'))));

		$query = $this->m_transaksi_lapangan->simpan_customer($array_customer);

		$diskon = "";
		$override = "";
		$total_bayar = $this->input->post('total_bayar');
		
		if(null != $this->input->post('override') || "" != $this->input->post('override')){
			$override = $this->input->post('override');
			$diskon = $this->input->post('diskon');
		} else{
			if($this->input->post('diskon') != 0){
				$total_bayar += $this->input->post('diskon');				
			}
			$diskon = 0;
		}

		$array_nota = array(
			"bayar_dp" => $this->input->post('bayar_dp'),
			"tgl_dp" => date('Y-m-d', strtotime($this->input->post('tgl_dp'))),
			"lapangan" => $this->input->post('lapangan'),
			"tgl_main" => date('Y-m-d', strtotime($this->input->post('tgl_main'))),
			"jam_mulai" => $this->input->post('jam_mulai'),
			"jam_selesai" => $this->input->post('jam_selesai'),
			"total_bayar" => $total_bayar,
			"id_customer" => $this->input->post('telp'),
			"diskon" => $diskon,
			"bonus" => $this->input->post('bonus'),
			"keterangan" => $this->input->post('keterangan'),
			"override" => $override,
			"id_operator" => $this->session->userdata('user_data')['user_id'],
			"status" => "DP"
		);
	
		if($query){
			$query = $this->m_transaksi_lapangan->simpan_transaksi($array_nota);
		}else{

		}
		redirect('');
	}

	public function simpan_pelunasan_dp(){
		if ($this->session->userdata('user_data') == "") {
			redirect('home');
		}

		//$jml_jam = $this->decimalHours($this->input->post('jam_selesai')) - $this->decimalHours($this->input->post('jam_mulai'));

		$diskon = 0;
		$override = "";
		$total_bayar = $this->input->post('total_bayar');
		$bayar_lunas = $this->input->post('bayar_lunas');

		if(null != $this->input->post('override') || "" != $this->input->post('override')){
			$override = $this->input->post('override');
			$diskon = $this->input->post('diskon');
		} else{
			if($this->input->post('diskon') != 0){
				$total_bayar += $this->input->post('diskon');
				$bayar_lunas += $this->input->post('diskon');
			}
			$diskon = 0;
		}

		$array_nota = array(
			"id_nota_lapangan" => $this->input->post('id_nota_lapangan'),
			"total_bayar" => $total_bayar,
			"bayar_lunas" => $bayar_lunas,
			"diskon" => $diskon,
			"tgl_lunas" => date('Y-m-d', strtotime($this->input->post('tgl_lunas'))),
			"id_operator" => $this->session->userdata('user_data')['user_id'],
			"override" => $override,
			"keterangan" => $this->input->post('keterangan'),
			"status" => "2"
		);	

		//print_r($array_nota); die;

		$query = $this->m_transaksi_lapangan->simpan_pelunasan_dp($array_nota);
		
		redirect('');
	}

	public function simpan_edit_dp(){
		if ($this->session->userdata('user_data') == "") {
			redirect('home');
		}

		$jml_jam_old = $this->decimalHours($this->input->post('jam_selesai_old')) - $this->decimalHours($this->input->post('jam_mulai_old'));
		$jml_jam = $this->decimalHours($this->input->post('jam_selesai')) - $this->decimalHours($this->input->post('jam_mulai'));
		$jml_jam = $jml_jam_old - $jml_jam;

		$array_customer = array(
			"nama" => $this->input->post('nama'),
			"telp" => $this->input->post('telp'),
			"jml_jam" => $jml_jam,
			"main_terakhir" => date('Y-m-d', strtotime($this->input->post('tgl_main'))));

		//$query = $this->m_transaksi_lapangan->simpan_edit_customer($array_customer);

		$diskon = "";
		$override = "";
		
		if(null !== $this->input->post('override')){
			$override = $this->input->post('override');
		}

		$array_nota = array(
			"id_nota_lapangan" => $this->input->post('id_nota_lapangan'),
			"bayar_dp" => $this->input->post('bayar_dp'),
			"tgl_dp" => date('Y-m-d', strtotime($this->input->post('tgl_dp'))),
			"lapangan" => $this->input->post('lapangan'),
			"tgl_main" => date('Y-m-d', strtotime($this->input->post('tgl_main'))),
			"jam_mulai" => $this->input->post('jam_mulai'),
			"jam_selesai" => $this->input->post('jam_selesai'),
			"total_bayar" => $this->input->post('total_bayar'),
			"id_customer" => $this->input->post('telp'),
			"diskon" => $this->input->post('diskon'),
			"bonus" => $this->input->post('bonus'),
			"keterangan" => $this->input->post('keterangan'),
			"override" => $override,
			"id_operator" => $this->session->userdata('user_data')['user_id'],
			"status" => "DP"
		);

		print_r($array_nota); die;
	
		if($query){
			$query = $this->m_transaksi_lapangan->simpan_edit_dp($array_nota);
		}else{

		}
		redirect('');
	}

	public function batal_transaksi($id, $id_customer){
		if ($this->session->userdata('user_data') == "") {
			redirect('home');
		}
		
		$result = $this->m_transaksi_lapangan->batal_transaksi($id, $id_customer);
		if($result == true){
			redirect('tlapangan');
		}else{
			return false;
		}
	}
}
?>

