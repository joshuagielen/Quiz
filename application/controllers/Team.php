<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller {

	 public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library(array('session', 'form_validation'));
    }



    public function index(){
        $this->load->view('login');
        $this->load->view('nieuwTeam');

    }

    public function loginTeam(){
        //get the posted values
          $teamName = $this->input->post("loginTeamName");
          $teamPassword = $this->input->post("loginTeamPassword");

          //set validations
          $this->form_validation->set_rules("loginTeamName", "teamPassword", "trim|required");
          $this->form_validation->set_rules("loginTeamPassword", "teamPassword", "trim|required");

          if ($this->form_validation->run() == FALSE)
          {
               //validation fails
                $this->load->view('login');
                $this->load->view('nieuwTeam');
          }
          else
          {
               //validation succeeds
               if (isset( $_POST['loginTeam'] ))
               {
                    //check if username and password is correct
                    $this->load->model('LoginModel');
                    $usr_result = $this->LoginModel->get_user($teamName, $teamPassword, 'teams');
                    if ($usr_result > 0) //active user record is present
                    {


                      //get teamcolor
                      $this->load->model('TeamModel');
                      $teamColor = $this->TeamModel->getTeamColor($teamName);
                      
                         //set the session variables
                         $sessiondata = array(
                              'username' => $teamName,
                              'normalUser' => TRUE,
                              'teamName' => $teamName,
                              'teamColor' => $teamColor

                         );
                         $this->session->set_userdata($sessiondata);
                         redirect(base_url('/Quiz'));
                    }
                    else
                    {
                         $this->session->set_flashdata('loginMsg', '<div class="alert alert-danger text-center">Invalid teamname and password!</div>');
                         redirect(base_url('/Team/loginTeam'));
                    }
               }
               else
               {
                $this->session->set_flashdata('loginMsg', '<div class="alert alert-danger text-center">Something went wrong, contact one of the admins</div>');
                    redirect(base_url('/Team/loginTeam'));
                    
               }
          }
    }

	public function registerTeam()
	{



        //register team 
		//set validation rules
        $this->form_validation->set_rules('teamName', 'Teamname', 'is_unique[teams.teamName]');

        //run validation on form input
        if ($this->form_validation->run() == FALSE || empty($_POST['teamName']) )
        {
            //validation fails
            $this->load->view('login');
            $this->load->view('nieuwTeam');
        }
        else
        {

        	  //Add team
            $this->load->model('TeamModel');
            $teamName = $this->input->post("teamName");
            $teamColor = $this->input->post("teamColor");
            $teamPassword = $this->TeamModel->generate_password(4);
        	$teamData = array(
				"teamName" => $teamName,
				"teamColor" => $teamColor,
				"teamPassword" => $teamPassword
			);

              
            

            //add players 
                $players = $_POST['playerName'];

                
               
               
            
                $playerInsertok = True;

		

            if ($this->TeamModel->insertTeam($teamData) )
            {    
                 $teamId = $this->TeamModel->getTeamId($teamName);

                   $playerData = array();
                   $i=0;
                    foreach( $players as $player ) {

                        $playerData[$i] = array(
                            "playerName" => $player,
                            "teamId" => $teamId
                        );

                        $this->load->model('PlayerModel');
                        if(!($this->PlayerModel->insertPlayer($playerData[$i])))
                        {
                            $playerInsertok = False;
                        }

                        $i++;
                    }


                if ($playerInsertok)
                {  
                   

                // team and players added
                  $flashdata = "<div class='alert alert-success text-center'>Jouw team is succesvol toevoegd! </br>Team name:" . $teamName . "</br>Team color: 
                  <canvas id='myCanvas' width='12' height='12' style='background-color:" .  $teamColor . "'></canvas>  </br>wachtwoord: <b>" . $teamPassword . "</b></div>";



                $this->session->set_flashdata('teamMsg',$flashdata);
               


                redirect(base_url('/Team/index'));

                }
                
                       


               
            }
            else
            {
                //error
                $this->session->set_flashdata('teamMsg','<div class="alert alert-danger text-center">Er is een fout opgetreden bij het aanmaken van het team</div>');
                redirect(base_url('/Team/index'));
            }

        
        }



		
	}




}
