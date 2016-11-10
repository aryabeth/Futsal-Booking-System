<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class m_laporan_cashflow_pib extends CI_Model{

	var $table_pickup = 'cash_pickup';
	var $table_inject = 'cash_inject';
	var $table_deposit_bank = 'cash_deposit';
	var $table_koreksi_cash = 'koreksi_cash';
	var $table_user = 'user';


	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	function get_data_cash($monthyear, $user_id) {
		if ($user_id == 0) {
			$query = $this->db->query('
				SELECT tgl_waktu, "'."CASH PICKUP".'" AS transaksi, status, keterangan, jml AS kredit, "'."".'" AS debet
				FROM cash_pickup 
				WHERE tgl_waktu LIKE "'.$monthyear.'%"
					UNION ALL
				SELECT tgl_waktu, "'."CASH INJECT".'" AS transaksi, status, keterangan, "'."".'" AS kredit, jml AS debet
				FROM cash_inject 
				WHERE tgl_waktu LIKE "'.$monthyear.'%"
					UNION ALL
				SELECT tgl_waktu, "'."CASH DEPOSIT (BANK)".'" AS transaksi, status, keterangan, jml AS kredit, "'."".'" AS debet
				FROM cash_deposit
				WHERE tgl_waktu LIKE "'.$monthyear.'%"
					
					UNION ALL

				SELECT tanggal_koreksi AS tgl_waktu, "'."[KOREKSI] CASH PICKUP".'" AS transaksi, status, keterangan, "'."".'" AS kredit, jumlah AS debet
				FROM koreksi_cash
				WHERE tanggal_koreksi LIKE "'.$monthyear.'%" AND transaksi LIKE "'."Cash Pick Up".'"
					UNION ALL
				SELECT tanggal_koreksi AS tgl_waktu, "'."[KOREKSI] CASH INJECT".'" AS transaksi, status, keterangan, jumlah AS kredit, "'."".'" AS debet
				FROM koreksi_cash
				WHERE tanggal_koreksi LIKE "'.$monthyear.'%" AND transaksi LIKE "'."Cash Inject".'"
					UNION ALL
				SELECT tanggal_koreksi AS tgl_waktu, "'."[KOREKSI] CASH DEPOSIT (BANK)".'" AS transaksi, status, keterangan, "'."".'" AS kredit, jumlah AS debet
				FROM koreksi_cash
				WHERE tanggal_koreksi LIKE "'.$monthyear.'%" AND transaksi LIKE "'."Cash Deposit(Bank)".'"

					ORDER BY tgl_waktu, transaksi, status, keterangan
			');
		}
		else {
			// in case of koreksi_cash
			$this->db->from($this->table_user);
			$this->db->where('user_id',$user_id);
			$q = $this->db->get();
			$username = $q->result()[0]->username;

			$query = $this->db->query('
				SELECT tgl_waktu, "'."CASH PICKUP".'" AS transaksi, status, keterangan, jml AS kredit, "'."".'" AS debet
				FROM cash_pickup 
				WHERE id_operator='.$user_id.' AND tgl_waktu LIKE "'.$monthyear.'%"
					UNION ALL
				SELECT tgl_waktu, "'."CASH INJECT".'" AS transaksi, status, keterangan, "'."".'" AS kredit, jml AS debet
				FROM cash_inject 
				WHERE id_operator='.$user_id.' AND tgl_waktu LIKE "'.$monthyear.'%"
					UNION ALL
				SELECT tgl_waktu, "'."CASH DEPOSIT (BANK)".'" AS transaksi, status, keterangan, jml AS kredit, "'."".'" AS debet
				FROM cash_deposit
				WHERE id_operator='.$user_id.' AND tgl_waktu LIKE "'.$monthyear.'%"

					UNION ALL

				SELECT tanggal_koreksi AS tgl_waktu, "'."[KOREKSI] CASH PICKUP".'" AS transaksi, status, keterangan, "'."".'" AS kredit, jumlah AS debet
				FROM koreksi_cash
				WHERE operator="'.$username.'" AND tanggal_koreksi LIKE "'.$monthyear.'%" AND transaksi LIKE "'."Cash Pick Up".'"
					UNION ALL
				SELECT tanggal_koreksi AS tgl_waktu, "'."[KOREKSI] CASH INJECT".'" AS transaksi, status, keterangan, jumlah AS kredit, "'."".'" AS debet
				FROM koreksi_cash
				WHERE operator="'.$username.'" AND tanggal_koreksi LIKE "'.$monthyear.'%" AND transaksi LIKE "'."Cash Inject".'"
					UNION ALL
				SELECT tanggal_koreksi AS tgl_waktu, "'."[KOREKSI] CASH DEPOSIT (BANK)".'" AS transaksi, status, keterangan, "'."".'" AS kredit, jumlah AS debet
				FROM koreksi_cash
				WHERE operator="'.$username.'" AND tanggal_koreksi LIKE "'.$monthyear.'%" AND transaksi LIKE "'."Cash Deposit(Bank)".'"

					ORDER BY tgl_waktu, transaksi, status, keterangan
			');
		}

		return $query->result();
	}

	function get_data_user() {
		$this->db->from($this->table_user);
		$query = $this->db->get();

		return $query->result();
	}
}