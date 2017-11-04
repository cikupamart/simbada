<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->_chk_auth();
	}

	public function index()
	{
		// Data untuk title header
		$data_header["title"] = "Dashboard";
		// END Data untuk title header

		$this->load->view('template/header', $data_header);
		$this->load->view("welcome_message");
		$this->load->view('template/footer');
	}

	private function _chk_auth()
	{
		if ($this->session->userdata('is_logged_in') !== TRUE)
		{
			redirect("auth", "refresh");
		}
	}
}
