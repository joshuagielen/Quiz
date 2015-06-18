<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


	public function index()
	{
		$this->load->helper('url');
		
		$this->load->view('admin_nav');
		$this->load->view('admin_footer');
	}

	public function teams($teamId){

		//get team from database
		$this->load->helper('url');
		




		$this->load->model('TeamModel');
		

		$data['team'] =  $this->TeamModel->getTeamById($teamId);
		$data['players'] =  $this->TeamModel->getPlayersById($teamId);
		
		
		
		$this->load->view('admin_nav');
		$this->load->view('admin_team',$data);
		$this->load->view('admin_footer');


	}
}


