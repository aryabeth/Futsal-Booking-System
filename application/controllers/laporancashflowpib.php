<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporancashflowpib extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_laporan_cashflow_pib','laporan_cashflow_pib');
	}

	function index() {
		if (!isset($this->session->userdata('user_data')['username'])) {
			redirect('home');
		}

        $this->load->helper('url');
		$this->load->view('laporancashflowpib');
	}

    function ajax_list($monthyear, $user_id) {
    	$list = $this->laporan_cashflow_pib->get_data_cash($monthyear, $user_id);
    	$data = array();
    	$saldo = 0;
    	if (!empty($list)) {
    		$now = substr($list[0]->tgl_waktu, 8, 2);
    	}

        foreach ($list as $cash) {
        	// get day
            $tmp = substr($cash->tgl_waktu, 8, 2);

            // when change date
            if ($tmp != $now) {
            	// add padding
            	$row = array();
            	$row[] = '';
            	$row[] = '';
            	// $row[] = '';
            	$row[] = '';
            	$row[] = '';
                $row[] = '';
	            $row[] = number_format($saldo, 0, ',', '.');
	  
	            $data[] = $row;

	            // reset condition
            	$saldo = 0;
				$now = $tmp;           	
            }

            // change if status is CANCELED
            $cash_kredit = $cash->status != 'CANCELED' ? $cash->kredit : $cash->debet;
            $cash_debet  = $cash->status != 'CANCELED' ? $cash->debet : $cash->kredit;

            // sum up saldo every day
            $saldo = $saldo - $cash_kredit + $cash_debet;

        	$row = array();
            $row[] = $this->convertDate($cash->tgl_waktu);
            $row[] = $cash->transaksi;
            // $row[] = $cash->status;
            $row[] = $cash->keterangan;
            $row[] = number_format((int)$cash_kredit, 0, ',', '.');
            $row[] = number_format((int)$cash_debet, 0, ',', '.');
            $row[] = '';
  
            $data[] = $row;
        }

        // add padding
        if (!empty($list)) {
        	$row = array();
	    	$row[] = '';
	    	$row[] = '';
	    	// $row[] = '';
	    	$row[] = '';
	    	$row[] = '';
            $row[] = '';
	        $row[] = number_format($saldo, 0, ',', '.');

	        $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    function ajax_get_user()
    {
    	$list = $this->laporan_cashflow_pib->get_data_user();
        $data = array();

        foreach ($list as $user) {
            $row = array();
            $row[] = $user->user_id;
            $row[] = $user->username;
            
            $data[] = $row;
        }

        echo json_encode($data);
    }

    function get_saldo($monthyear, $user_id) {
        //*** modification of ajax_list()
        

        $list = $this->laporan_cashflow_pib->get_data_cash($monthyear, $user_id);
        $data = array();
        $data[0] = 0;
        $saldo = 0;
        if (!empty($list)) {
            $now = substr($list[0]->tgl_waktu, 8, 2);
        }

        foreach ($list as $cash) {
            // get day
            $tmp = substr($cash->tgl_waktu, 8, 2);

            // when change date
            if ($tmp != $now) {
                $data[0] += $saldo;

                // reset condition
                $saldo = 0;
                $now = $tmp;            
            }

            // change if status is CANCELED
            $cash_kredit = $cash->status != 'CANCELED' ? $cash->kredit : $cash->debet;
            $cash_debet  = $cash->status != 'CANCELED' ? $cash->debet : $cash->kredit;

            // sum up saldo every day
            $saldo = $saldo - $cash_kredit + $cash_debet;
        }

        // add padding
        if (!empty($list)) {
            $data[0] += $saldo;
        }


        //output to json format
        $data[0] = number_format($data[0], '0', ',', '.');
        echo json_encode($data);
    }



    function convertDate($date) {
        $year = substr($date, 0, 4);
        $month = substr($date, 5, 2);
        $day = substr($date, 8, 2);
        $time = substr($date, -8);

        return $day." ".$this->convertMonth($month)." ".$year." / ".$time;
    }

    function convertMonth($m) {
        switch($m) {
            case '01' : return "Januari";
            case '02' : return "Februari";
            case '03' : return "Maret";
            case '04' : return "April";
            case '05' : return "Mei";
            case '06' : return "Juni";
            case '07' : return "Juli";
            case '08' : return "Agustus";
            case '09' : return "September";
            case '10' : return "Oktober";
            case '11' : return "November";
            case '12' : return "Desember";
            default : return "00";
        }
    }
}