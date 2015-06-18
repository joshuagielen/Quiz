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
        if ($this->form_validation->run() == FALSE || empty($_POST['teamName']) )
        {
            //validation fails
            $this->load->view('team');
        }
        else
        {

        	  //Add team
            $this->load->model('TeamModel');
            $teamName = $this->input->post("teamName");
            $wachtwoord = $this->TeamModel->generate_password(4);
        	$teamData = array(
				"teamName" => $teamName,
				"teamColor" => "red",
				"teamPassword" => $wachtwoord
			);

            
            

            //add players 
                $players = $_POST['playerName'];

                
               
               
            


		

            if ($this->TeamModel->insertData('teams',$teamData) )
            {    
                 $teamId = $this->TeamModel->getId($teamName);

                   $playerData = array();
                    foreach( $players as $player ) {
                        $playerData = array(
                            "playerName" => $player,
                            "teamId" => $teamId
                        );
                    }


                if ($this->TeamModel->insertData('players',$playerData) )
                {  
                   

                // team and players added
                $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Jouw team is succesvol toevoegd! </br>wachtwoord: <b> ' . $wachtwoord . '</b></br>TeamId: ' . $teamId . '</div>');
                redirect('http://' . base_url('/Team/index'));

                }
                
                       


               
            }
            else
            {
                //error
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Er is een fout opgetreden bij het aanmaken van het team</div>');
                redirect('http://' . base_url('/Team/index'));
            }

        
        }



		
	}




}
