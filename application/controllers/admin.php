<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	 public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library(array('session', 'form_validation'));
    }



	public function index()
	{
		$this->load->helper('url');
		$this->load->model('TeamModel');
		$data['teamsnav'] = $this->TeamModel->getData('teams');

		$this->load->view('admin_nav',$data);
		$this->load->view('admin_footer');
	}

	public function teams($teamId){

		//get team from database
		$this->load->helper('url');
		




		$this->load->model('TeamModel');
		

		$data['teams'] =  $this->TeamModel->getTeamById($teamId);
		$data['players'] =  $this->TeamModel->getPlayersById($teamId);
		
		$data['teamsnav'] = $this->TeamModel->getData('teams');
		
		$this->load->view('admin_nav',$data);
		$this->load->view('admin_team',$data);
		$this->load->view('admin_footer');


	}


	public function updatePlayer(){
		$this->load->helper('url');

		$this->load->model('TeamModel');
			$playerId = $this->input->post("playerId");
            $newPlayerName = $this->input->post("newPlayerName");
            $teamId = $this->input->post("teamId");




            $data = array(
               'playerName' => $newPlayerName
            );

            if ($this->TeamModel->updatePlayer($playerId, $data))
            {
            	 redirect('http://' . base_url('admin/teams') ."/" .$teamId);

            }

	}

	public function updateTeam(){
		$this->load->helper('url');

		$this->load->model('TeamModel');
			$newTeamName = $this->input->post("newTeamName");
            $teamId = $this->input->post("teamId");




            $data = array(
               'teamName' => $newTeamName
            );

            if ($this->TeamModel->updateTeam($teamId, $data))
            {
            	 redirect('http://' . base_url('admin/teams') ."/" .$teamId);

            }

	}


	public function deletePlayer($playerId,$teamId){
		$this->load->helper('url');

		$this->load->model('TeamModel');
		 

		if ($this->TeamModel->deletePlayer($playerId))
            {
            	 redirect('http://' . base_url('admin/teams') ."/" .$teamId);

            }
			

	}
	public function deleteTeam($teamId){
		$this->load->helper('url');

		$this->load->model('TeamModel');
		 

		if ($this->TeamModel->deleteTeam($teamId))
            {
            	 redirect('http://' . base_url('admin/index'));

            }
			

	}

	public function newTeam(){
		$this->load->helper('url');
		$this->load->model('TeamModel');
		$data['teamsnav'] = $this->TeamModel->getData('teams');

		$this->load->view('admin_nav',$data);
		$this->load->view('admin_add_team');

		$this->load->view('admin_footer');
	}

	public function addNewTeam(){
		//set validation rules
        $this->form_validation->set_rules('teamName', 'Teamname', 'is_unique[teams.teamName]');

        //run validation on form input
        if ($this->form_validation->run() == FALSE || empty($_POST['teamName']) )
        {
            //validation fails
            $this->load->helper('url');
			$this->load->model('TeamModel');
			$data['teamsnav'] = $this->TeamModel->getData('teams');
			$this->load->view('admin_nav',$data);
            $this->load->view('admin_add_team');
            $this->load->view('admin_footer');
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

                
               
               
            
                $playerInsertok = True;

		

            if ($this->TeamModel->insertData('teams',$teamData) )
            {    
                 $teamId = $this->TeamModel->getId($teamName);

                   $playerData = array();
                   $i=0;
                    foreach( $players as $player ) {

                        $playerData[$i] = array(
                            "playerName" => $player,
                            "teamId" => $teamId
                        );

                        
                        if(!($this->TeamModel->insertData('players',$playerData[$i])))
                        {
                            $playerInsertok = False;
                        }

                        $i++;
                    }


                if ($playerInsertok)
                {  
                   

                // team and players added
                $this->session->set_flashdata('msg','<div class="alert alert-success text-center">team is succesvol toevoegd! </br>wachtwoord: <b> ' . $wachtwoord . '</b></br>TeamId: ' . $teamId . '</div>');
                redirect('http://' . base_url('/Admin/newTeam'));

                }
                
                       


               
            }
            else
            {
                //error
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Er is een fout opgetreden bij het aanmaken van het team</div>');
                redirect('http://' . base_url('/Admin/newTeam'));
            }

        
        }



		
	}



}


