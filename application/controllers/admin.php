<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


	public function index()
	{
		$this->load->helper('url');
		$this->load->view('admin_nav');
	}

	public function teams(){
		
	}
}


