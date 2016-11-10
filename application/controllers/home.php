<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event {}
class Home extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('m_transaksi_lapangan');
	}

	public function index()
	{
		if (isset($this->session->userdata('user_data')['username'])) {
			$enum['enum_lapangan'] = $this->m_transaksi_lapangan->get_enum_lapangan();
			$this->load->view('home', $enum);
		}else{
			redirect('login');
		}
	}

	public function get_data_transaksi($enum="", $start, $end)
	{
		$array = $this->m_transaksi_lapangan->get_data_transaksi_home($enum, $start, $end);
		//print_r($array); die;
		$events = array();
		foreach ($array as $row) {
			$e = new Event();
			$e->id = $row['id_nota_lapangan'];
			$e->text = $row['nama'];
			$e->start = $row['tgl_main'].'T'.$row['jam_mulai'];
			$e->end = $row['tgl_main'].'T'.$row['jam_selesai'];
			$e->toolTip = $row['nama'];
			$e->tag = array("tgl_main" => $row['tgl_main'],
					"jam_mulai" => $row['jam_mulai'],
					"jam_selesai" => $row['jam_selesai'],
					"tgl_dp" => $row['tgl_dp'],
					"bayar_dp" => $row['bayar_dp'],
					"bayar_lunas" => $row['bayar_lunas'],
					"tgl_lunas" => $row['tgl_lunas'],
					"diskon" => $row['diskon'],
					"override" => $row['override'],
					"total_bayar" => $row['total_bayar'],
					"lapangan" => $row['lapangan'],
					"bonus" => $row['bonus'],
					"keterangan" => $row['keterangan'],
					"id_operator" => $row['id_operator'],
					"status" => $row['status'],
					"telp" => $row['id_customer']);
			$events[] = $e;
		}
		header('Content-Type: application/json');
		echo json_encode($events);
	}

	public function check_data_transaksi()
	{
		$id_nota = "";
		if(isset($_POST['id_nota_lapangan']))
			$id_nota = $_POST['id_nota_lapangan'];
		$array = array(
				'tgl_main' => date('Y-m-d', strtotime($_POST['tgl_main'])),
				'jam_mulai' => $_POST['jam_mulai'],
				'jam_selesai' => $_POST['jam_selesai'],
				'lapangan' => $_POST['lapangan'],
				'id_nota_lapangan' => $id_nota);
		$result = $this->m_transaksi_lapangan->check_data_transaksi($array);

		if($result != FALSE){
			$result[0]['status'] = "FOUND";
		} else {
			$result = array("0" => array('status' => "CLEAR"));	
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}	
}