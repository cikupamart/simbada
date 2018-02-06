<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->template->chk_auth();
	}

	public function index()
	{
		// Data untuk title header
		$this->template->set("title", "Dashboard");
		$data["bt"] = "Selamat datang di SIMBADA";
		// END Data untuk title header

		$this->template->load("template/template", "welcome_message", $data);
	}
}
