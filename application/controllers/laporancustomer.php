<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporancustomer extends CI_Controller {

	function __construct() {
		parent::__construct();
		
	}

	public function index()
	{
		// if (isset($this->user) && !empty($this->user)) {
		// 	redirect('home');
		// }

		$this->load->view('laporancustomer');

	}
	

}

