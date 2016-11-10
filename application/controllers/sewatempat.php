<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sewatempat extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_sewatempat');
		$this->load->model('m_override_pengguna','override_pengguna');
	}

	public function index()
	{
		if (isset($this->session->userdata('user_data')['username'])) {
			$year_now = date('Y');
			$month_now = date('m');
			$data['id_nota'] = $this->m_sewatempat->create_nota($year_now, $month_now);
			$data['listsewatempat'] =$this->m_sewatempat->get_list_sewatempat();
			$this->load->helper('url');
			$this->load->view('sewatempat',$data);
		}else{	
			redirect('login');
		}

	}
	
	function tambah(){
		$id_nota = $this->input->post('id_nota');
		$tgl_nota = $this->input->post('tgl_waktu');
        $nama_penyetor = $this->input->post('penyewa');
     	$jumlah = $this->input->post('jumlah'); 
     	$keterangan = $this->input->post('ket');
     	$status = 'NEW';
     	$data = array(
     		'id_nota' => $id_nota,
			'tanggal' => $tgl_nota,
			'penyewa' => $nama_penyetor,
			'jumlah' => $jumlah,
			'ket' => $keterangan,
			'status' => $status,
		);
		$this->m_sewatempat->add($data);
		redirect('sewatempat');
	}

	function hapus($id){
		$this->m_sewatempat->hapus($id);
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

