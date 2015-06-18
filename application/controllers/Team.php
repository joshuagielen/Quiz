<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller {

	 public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library(array('session', 'form_validation'));
    }




	public function index()
	{
		//set validation rules
        $this->form_validation->set_rules('teamName', 'Teamname', 'is_unique[teams.teamName]');

        //run validation on form input
        if ($this->form_validation->run() == FALSE)
        {
            //validation fails
            $this->load->view('team');
        }
        else
        {

        	  //get the form data
        	$teamData = array(
				"teamName" => $this->input->post("teamName"),
				"teamColor" => "red",
				"teamPassword" => $this->TeamModel->generate_password(8,3)
			);


			if ($this->TeamModel->insertData($teamData))
            {
                // mail sent
                $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Your mail has been sent successfully!</div>');
                redirect('Team/index');
            }
            else
            {
                //error
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">There is error in sending mail! Please try again later</div>');
                redirect('Team/index');
            }

        
        }



		
	}




}
