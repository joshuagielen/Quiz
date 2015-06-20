<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends CI_Controller {

	 public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library(array('session', 'form_validation'));
	
	    if ( ! $this->session->userdata('normalUser') )
        { 
             redirect('http://' . base_url('/Team/loginTeam'));
        }






        $this->load->helper('url');
        $this->load->library(array('session', 'form_validation'));

    }



    public function index(){

        $this->load->model('PlayerModel');
        $data['players'] = $this->PlayerModel->getData('players');


        $this->load->view('quiz_nav');
        $this->load->view('quiz_welcome', $data);
        

    }

    public function logOut(){
    	$this->session->unset_userdata('username');
		$this->session->unset_userdata('normalUser');
		$this->session->sess_destroy();
		redirect('http://' . base_url('/Team/loginTeam'));
    }



   
         
             


}
