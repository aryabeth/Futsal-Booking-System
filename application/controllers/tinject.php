<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tinject extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_cash_inject','cash_inject');
        $this->load->model('m_override_pengguna','override_pengguna');
	}

	function index() {
		if (!isset($this->session->userdata('user_data')['username'])) {
			redirect('home');
		}

        $this->load->helper('url');
		$this->load->view('tinject');
	}


	// CRUD USING AJAX
	public function ajax_list()
    {
        $list = $this->cash_inject->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $cash_inject) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $this->convertDate($cash_inject->tgl_waktu);
            $row[] = $cash_inject->nota;
            $row[] = $cash_inject->nama;
            $row[] = number_format($cash_inject->jml, 0, '', '.');
            $row[] = $cash_inject->keterangan;
            $row[] = "ID: ".$cash_inject->id_operator." (".$this->convertUserId($cash_inject->id_operator).")";
            $row[] = "ID: ".$cash_inject->override." (".$this->convertUserId($cash_inject->override).")";
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->cash_inject->count_all(),
                        "recordsFiltered" => $this->cash_inject->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($id)
    {
        $data = $this->cash_inject->get_by_id($id);
        $data->tgl_waktu = ($data->tgl_waktu == '0000-00-00') ? '' : $data->tgl_waktu; // if 0000-00-00 set tu empty for datepicker compatibility
        $data->override_username = $this->convertUserId($data->override);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->input_validation();
        $data = array(
                'tgl_waktu' => $this->input->post('tgl_waktu'),
				'nota' => $this->input->post('nota'),
				'nama' => $this->input->post('nama'),
				'jml' => $this->input->post('jml'),
				'keterangan' => $this->input->post('keterangan'),
				'id_operator' => $this->session->userdata('user_data')['user_id'],
				'override' => $this->input->post('override'),
				'status' => 'NEW',
            );
        $insert = $this->cash_inject->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_get_nota()
    {        
        $data = $this->cash_inject->get_nota()->COLUMN_TYPE;    // return : enum('A','B','C')
        $data = trim($data, "enum(");
        $data = trim($data, ")");
        $data = str_replace("'", "", $data);    // replace : ')' --> ''
        $data = explode(",", $data);    // convert into array of string, with delimiter of ","

        echo json_encode($data);
    }
 
    public function ajax_update()
    {
        $this->input_validation();
        $data = array(
                'tgl_waktu' => $this->input->post('tgl_waktu'),
				'nota' => $this->input->post('nota'),
				'nama' => $this->input->post('nama'),
				'jml' => $this->input->post('jml'),
				'keterangan' => $this->input->post('keterangan'),
				'id_operator' => $this->session->userdata('user_data')['user_id'],
				'override' => $this->input->post('override'),
				'status' => 'UPDATED',
            );
        $this->cash_inject->update(array('id_inject' => $this->input->post('id_inject')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id)
    {
        // $this->cash_inject->delete_by_id($id);
        $data = array(
                'tgl_waktu' => $this->cash_inject->get_by_id($id)->tgl_waktu,
                'status' => 'CANCELED',
            );
        $this->cash_inject->update(array('id_inject' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }

    private function input_validation()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('tgl_waktu') == '')
        {
            $data['inputerror'][] = 'tgl_waktu';
            $data['error_string'][] = 'required';
            $data['status'] = FALSE;
        }
        elseif(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) ([0-1][0-9]|2[0-4]):([0-5][0-9]):([0-5][0-9])$/", $this->input->post('tgl_waktu')))
        {
            // check date format
            $data['inputerror'][] = 'tgl_waktu';
            $data['error_string'][] = 'wrong format';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('nota') == '')
        {
            $data['inputerror'][] = 'nota';
            $data['error_string'][] = 'required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('nama') == '')
        {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('jml') == '')
        {
            $data['inputerror'][] = 'jml';
            $data['error_string'][] = 'required';
            $data['status'] = FALSE;
        }
        elseif(!preg_match('/^[0-9]+$/', $this->input->post('jml')))
        {
            $data['inputerror'][] = 'jml';
            $data['error_string'][] = 'must be a number';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('keterangan') == '')
        {
            $data['inputerror'][] = 'keterangan';
            $data['error_string'][] = 'required';
            $data['status'] = FALSE;
        }

        if($this->input->post('override') == '')
        {
            $data['inputerror'][] = 'override';
            $data['error_string'][] = 'must be overrided';
            $data['status'] = FALSE;
        }


 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
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

    function convertUserId($id) {
        return $this->override_pengguna->get_username_by_id($id);
    }
}

