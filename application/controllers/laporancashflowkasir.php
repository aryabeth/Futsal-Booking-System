<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporancashflowkasir extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_laporan_cashflow_kasir','laporan_cashflow_kasir');
	}

	function index() {
		if (!isset($this->session->userdata('user_data')['username'])) {
			redirect('home');
		}

        $this->load->helper('url');
        $saldo=$this->laporan_cashflow_kasir->get_data_saldo(date('Y-m-d'));
        $lapangan=$this->laporan_cashflow_kasir->get_data_lapangan(date('Y-m-d'));
        $deposit=$this->laporan_cashflow_kasir->get_data_deposit(date('Y-m-d'));
        //$result=$this->laporan_cashflow_kasir->get_data('2016-06-13ukh');
        $result['saldo']=$saldo;
        $result['lapangan']=$lapangan;
        $result['deposit']=$deposit;
        //print_r($result); die;
		$this->load->view('laporancashflowkasir', $result);
	}
}