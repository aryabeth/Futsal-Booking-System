<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class m_laporan_cashflow_kasir extends CI_Model{

	var $table_pickup = 'cash_pickup';
	var $table_inject = 'cash_inject';
	var $table_deposit_bank = 'cash_deposit';
	var $table_user = 'user';


	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	function get_data_saldo($tgl) {
		$result = $this->db->query("SELECT max(tanggal), total_kredit, total_debet, saldo FROM `cashflow` WHERE tanggal < '".$tgl."'");
		return $result->result_array();
	}

	function get_data_lapangan($tgl) {
		$result = $this->db->query("SELECT IF(status='DP', tgl_dp, tgl_lunas) as tanggal, concat(status, '-', id_nota_lapangan) as keterangan, IF(status='DP', bayar_dp, bayar_lunas) as kredit, status FROM `nota_lapangan` WHERE IF(status='DP', tgl_dp, tgl_lunas)='".$tgl."'");    	
    	return $result->result_array();
	}

	function get_data_deposit($tgl) {
		$result = $this->db->query("SELECT tgl_deposit as tanggal, concat('DEPOSIT-', id_nota_deposit) as keterangan, jml_deposit as kredit FROM `nota_deposit` WHERE `tgl_deposit`='".$tgl."'");
		return $result->result_array();
	}
}