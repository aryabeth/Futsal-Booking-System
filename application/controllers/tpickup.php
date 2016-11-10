<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tpickup extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_cash_pickup','cash_pickup');
        $this->load->model('m_override_pengguna','override_pengguna');
	}

	function index() {
		if (!isset($this->session->userdata('user_data')['username'])) {
			redirect('home');
		}

        $this->load->helper('url');
		$this->load->view('tpickup');
	}


	// CRUD USING AJAX
	public function ajax_list()
    {
        $list = $this->cash_pickup->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $cash_pickup) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $this->convertDate($cash_pickup->tgl_waktu);
            $row[] = $cash_pickup->id_nota;
            $row[] = $cash_pickup->nama;
            $row[] = number_format($cash_pickup->jml, 0, '', '.');
            $row[] = $cash_pickup->keterangan;
            $row[] = "ID: ".$cash_pickup->id_operator." (".$this->convertUserId($cash_pickup->id_operator).")";
            $row[] = "ID: ".$cash_pickup->override." (".$this->convertUserId($cash_pickup->override).")";

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->cash_pickup->count_all(),
                        "recordsFiltered" => $this->cash_pickup->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->cash_pickup->get_by_id($id);
        $data->tgl_waktu = ($data->tgl_waktu == '0000-00-00') ? '' : $data->tgl_waktu; // if 0000-00-00 set tu empty for datepicker compatibility
        $data->override_username = $this->convertUserId($data->override);
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $this->input_validation();
        $data = array(
                'tgl_waktu' => $this->input->post('tgl_waktu'),
				'id_nota' => $this->input->post('id_nota'),
				'nama' => $this->input->post('nama'),
				'jml' => $this->input->post('jml'),
				'keterangan' => $this->input->post('keterangan'),
				'id_operator' => $this->session->userdata('user_data')['user_id'],
				'override' => $this->input->post('override')
            );
        $insert = $this->cash_pickup->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        $this->input_validation();
        $data = array(
                'tgl_waktu' => $this->input->post('tgl_waktu'),
				'id_nota' => $this->input->post('id_nota'),
				'nama' => $this->input->post('nama'),
				'jml' => $this->input->post('jml'),
				'keterangan' => $this->input->post('keterangan'),
				'id_operator' => $this->session->userdata('user_data')['user_id'],
				'override' => $this->input->post('override'),
				'status' => 'UPDATED',	// what does it mean?
            );
        $this->cash_pickup->update(array('id_pickup' => $this->input->post('id_pickup')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        // $this->cash_pickup->delete_by_id($id);
        $data = array(
                'tgl_waktu' => $this->cash_pickup->get_by_id($id)->tgl_waktu,
                'status' => 'CANCELED'
            );
        $this->cash_pickup->update(array('id_pickup' => $id), $data);
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

        if($this->input->post('id_nota') == '')
        {
            $data['inputerror'][] = 'id_nota';
            $data['error_string'][] = 'please re-select the date';
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


    // GET id_nota
    public function get_id_nota($date) {
		$data['result'] = $this->cash_pickup->get_id_nota_this_month($date);
        echo json_encode($data);
    }


    // PRINT
    public function ajax_print($start, $end) {
        $option = $this->input->post('optionsPrint');
        $data = array();
        $data['status'] = TRUE;

        // validation
        if($start == 'none') {
            $data['error_string'] = "Please fill in the input field.";
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }

        $result = $this->cash_pickup->get_data($option, $start, $end);
        if($result) {
            if($result == "error_format") {
                $data['error_string'] = "Wrong time range format.";
                $data['status'] = FALSE;
                echo json_encode($data);
                exit();
            }

            $data['found'] = count($result);
            $data['result'] = $result;
            echo json_encode($data);
        }
        else {
            $data['error_string'] = "No data found.";
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
    }
}
