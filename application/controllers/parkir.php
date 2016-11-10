<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Parkir extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_parkir');
		$this->load->model('m_override_pengguna','override_pengguna');
		
	}

	public function index()
	{
		if (isset($this->session->userdata('user_data')['username'])) {
			$year_now = date('Y');
			$month_now = date('m');
			$data['id_nota'] = $this->m_parkir->create_nota($year_now, $month_now);
			$data['listparkir'] =$this->m_parkir->get_list_parkir();
			$this->load->helper('url');
			$this->load->view('parkir',$data);
		}else{	
			redirect('login');
		}

	}
	

	function tambah(){
		$tgl_nota = $this->input->post('tgl_waktu');
        $id_nota = $this->input->post('id_nota'); 
     	$nama_penyetor = $this->input->post('penyetor');
     	$jumlah = $this->input->post('jumlah'); 
     	$keterangan = $this->input->post('keterangan'); 
     	$id_operator = $this->input->post('user_id'); 
     	$status = 'NEW';
     	$data = array(
			'id_nota' => $id_nota,
			'tgl_nota' => $tgl_nota,
			'nama_penyetor' => $nama_penyetor,
			'jml' => $jumlah,
			'keterangan' => $keterangan,
			'status' => $status,
			'id_operator' => $id_operator
		);
		$this->m_parkir->add_parkir($data);
		redirect('parkir');
	}

	function hapus_parkir($id){
		$this->m_parkir->hapus_parkir($id);
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

