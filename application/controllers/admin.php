<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library(array('session', 'form_validation'));
    
    if ( ! $this->session->userdata('admin'))
    {    
        // Allow some methods?
      $allowed =  array(
                      'login'
                  );
      if ( ! in_array($this->router->fetch_method(), $allowed))
      {
       redirect(base_url('/Admin/login'));
     }
   }

 }



 

 public function index()
 {

  $this->dashboard();

}

public function login(){


        //get the posted values
  $adminName = $this->input->post("adminName");
  $adminPassword = $this->input->post("adminPassword");

          //set validations
  $this->form_validation->set_rules("adminName", "adminName", "trim|required");
  $this->form_validation->set_rules("adminPassword", "adminPassword", "trim|required");

  if ($this->form_validation->run() == FALSE)
  {
               //validation fails
    $this->load->view('admin_login');
  }
  else
  {
               //validation succeeds
      if (isset( $_POST['loginAdmin'] ))
      {
                      //check if username and password is correct
        $this->load->model('LoginModel');
        $usr_result = $this->LoginModel->get_user($adminName, $adminPassword, 'admins');
        
        if ($usr_result > 0) //active user record is present
        {
                           //set the session variables
          $sessiondata = array(
            'username' => $teamName,
            'logged_in' => TRUE,
            'admin' => TRUE
          );
                       
          $this->session->set_userdata($sessiondata);
          redirect(base_url('/Admin/index'));
        }
        else
        {
          $this->session->set_flashdata('loginMsg', '<div class="alert alert-danger text-center">Invalid name and password!</div>');
          redirect(base_url('/Admin/login'));
        }
    }
    else
    {
      $this->session->set_flashdata('loginMsg', '<div class="alert alert-danger text-center">Something went wrong, contact one of the admins</div>');
      redirect(base_url('/Admin/login'));

    }
}

}

public function logOut(){
  $this->session->unset_userdata('username');
  $this->session->unset_userdata('logged_in');
  $this->session->unset_userdata('admin');
  $this->session->sess_destroy();

  redirect(base_url('/Admin/'));

}


public function teams($teamId){

//get team from database
  $this->load->helper('url');

  $this->load->model('PlayerModel');
   $data = $this->loadNavData();

  $data['teams'] =  $this->TeamModel->getTeamById($teamId);
  $data['players'] =  $this->PlayerModel->getPlayersById($teamId);

  

  $this->load->view('admin_nav',$data);
  $this->load->view('admin_team',$data);
  $this->load->view('admin_footer');


}
public function addPlayer(){
  $this->load->helper('url');

  $this->load->model('PlayerModel');
  $playerName = $this->input->post("playerName");
  $teamId = $this->input->post("teamId");

  $data = array(
   'playerName' => $playerName,
   'teamId' => $teamId
   );

  if ($this->PlayerModel->insertPlayer($data))
  {
    redirect(base_url('admin/teams') ."/" .$teamId);

  }

}


public function updatePlayer(){
  $this->load->helper('url');

  $this->load->model('PlayerModel');
  $playerId = $this->input->post("playerId");
  $newPlayerName = $this->input->post("newPlayerName");
  $teamId = $this->input->post("teamId");

  $data = array(
   'playerName' => $newPlayerName
   );

  if ($this->PlayerModel->updatePlayer($playerId, $data))
  {
    redirect(base_url('admin/teams') ."/" .$teamId);

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
    redirect(base_url('admin/teams') ."/" .$teamId);

  }

}


public function deletePlayer($playerId,$teamId){
  $this->load->helper('url');

  $this->load->model('PlayerModel');


  if ($this->PlayerModel->deletePlayer($playerId))
  {
    redirect(base_url('admin/teams') ."/" .$teamId);

  }


}
public function deleteTeam($teamId){
  $this->load->helper('url');

  $this->load->model('TeamModel');


  if ($this->TeamModel->deleteTeam($teamId))
  {
    redirect(base_url('admin/index'));

  }


}

public function newTeam(){
  $this->load->helper('url');
  $this->load->model('TeamModel');

  $this->load->view('admin_nav',$this->loadTeamData());
  $this->load->view('admin_add_team');

  $this->load->view('admin_footer');
}

public function addNewTeam(){
//set validation rules
  $this->form_validation->set_rules('teamName', 'Teamname', 'is_unique[teams.teamName]');


  $this->load->model('TeamModel');
  $teamName = $this->input->post("teamName");
  $teamColor = $this->input->post("teamColor");
  $wachtwoord = $this->TeamModel->generate_password(4);


//run validation on form input

  if ($this->form_validation->run() == FALSE || empty($_POST['teamName']) )
  {
//validation fails
    $this->load->helper('url');
    $this->load->view('admin_nav',$this->loadNavData());
    $this->load->view('admin_add_team');
    $this->load->view('admin_footer');
  }
  else
  {

//Add team
    $teamName = $this->input->post("teamName");
    $teamColor = $this->input->post("teamColor");
    $wachtwoord = $this->TeamModel->generate_password(4);

    $teamData = array(
                      "teamName" => $teamName,
                      "teamColor" => $teamColor,
                      "teamPassword" => $wachtwoord
              );
//add players 
    $players = $_POST['playerName'];
    $playerInsertok = True;

    if ($this->TeamModel->insertTeam($teamData) )
    {    
     $teamId = $this->TeamModel->getId($teamName);

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
      $this->session->set_flashdata('msg','<div class="alert alert-success text-center">team is succesvol toevoegd! </br>wachtwoord: <b> ' . $wachtwoord . '</b></br>TeamId: ' . $teamId . '</div>');
      redirect(base_url('/Admin/newTeam'));

    }

  }
  else
  {
    //error
    $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Er is een fout opgetreden bij het aanmaken van het team</div>');
    redirect(base_url('/Admin/newTeam'));
  }


}

}

  public function questions(){

    $this->load->helper('url');
    $this->load->model('QuestionModel');
    $this->load->model('GenreModel');
    $this->load->model('TypeModel');
    $data = $this->loadNavData();
    $data['questions'] = $this->QuestionModel->getQuestions();
    $data['genres'] = $this->GenreModel->getGenres();
    $data['types'] = $this->TypeModel->getTypes();


    $this->load->model('AnswerModel');
    $data['answers']= $this->AnswerModel->getAllAnswers();
    $this->load->view('admin_nav', $data);
    $this->load->view('admin_questions');

    $this->load->view('admin_footer');

  }

  public function deleteQuestion($questionId){
      $this->load->helper('url');

    $this->load->model('QuestionModel');
    $this->load->model('AnswerModel');

    
     
    if($this->AnswerModel->deleteAnswerByQuestionId($questionId)){
         if ($this->QuestionModel->deleteQuestion($questionId))
          {
            redirect(base_url('admin/questions'));
          }
    }

   

  }
  public function updateQuestion(){
      $this->load->helper('url');

    $this->load->model('QuestionModel');
    $this->load->model('AnswerModel');
            $questionId = $this->input->post("questionId");
            $questionValue = $this->input->post("questionValue");
            $questionType = $this->input->post("questionType");
            $questionGenre = $this->input->post("questionGenre");





            $questionData = array(
               'questionValue' => $questionValue,
              'questionType' => $questionType,
              'questionGenre' => $questionGenre,
            );

            if ($this->QuestionModel->updateQuestion($questionId, $questionData))
            {

              $questionId = $this->QuestionModel->getQuestionIdByName($questionValue);
              $answers =  $this->input->post("answersUpdate");
              
              foreach($answers as $answer){
                 $answerId = $answer['answerId'];
                
                $answerData = array(
                                  "answerValue" => $answer['value'],
                                  "answerScoreValue" => $answer['score']
                                  );

                $this->AnswerModel->updateAnswer($questionId, $answerId, $answerData);
              }



               /*redirect(base_url('admin/questions'));*/

            }
    
  }
  public function addQuestion(){


    $this->load->helper('url');

    $this->load->model('QuestionModel');
    $this->load->model('TypeModel');
    $this->load->model('GenreModel');
    $this->load->model('AnswerModel');
    $questionValue = $this->input->post("questionValue");
   
    $this->form_validation->set_rules('questionValue', 'QuestionValue', 'is_unique[questions.questionValue]');

    if ($this->form_validation->run() == FALSE || empty($_POST['questionValue']) )
    {
  //validation fails
        $this->questions();
    }
    else
    {

        $questionType = $this->input->post("types");
        $questionGenre = $this->input->post("questionGenre");
        
        $questionGenre = $this->GenreModel->getGenreNameById($questionGenre);
        $questionType = $this->TypeModel->getTypeNameById($questionType);

        $questionData = array(
                            'questionValue' => $questionValue,
                            'questionType' => $questionType,
                            'questionGenre' => $questionGenre
                        );

        if ($this->QuestionModel->insertQuestion($questionData))
        {
          $questionId = $this->QuestionModel->getQuestionIdByName($questionValue);
          $answers =  $this->input->post("answers");
              foreach($answers as $answer){
              
              $answerData = array(
                                "questionId" => $questionId,
                                "answerValue" => $answer['value'],
                                "answerScoreValue" => $answer['score']
                                );

              $this->AnswerModel->insertAnswer($answerData);
              }

              $this->session->set_flashdata('questionMsg','<div class="alert alert-success text-center">"Question and answers added!</div>');
              redirect(base_url('admin/questions'));
        }

    }    
    
  }
  public function deleteRound($roundId){
  $this->load->helper('url');

  $this->load->model('RoundModel');


    if ($this->RoundModel->deleteRound($roundId))
    {
      if ($this->RoundModel->fixSequenceError()){
        redirect(base_url('admin/newRound'));
      }


      

    }
  }
  public function updateRound(){
      $this->load->helper('url');

    $this->load->model('RoundModel');
            $roundId = $this->input->post("roundId");
            $roundName = $this->input->post("roundName");


            $roundData = array(
               'roundName' => $roundName
            );

            if ($this->RoundModel->updateRound($roundId, $roundData))
            {
               redirect(base_url('admin/newRound'));

            }
    
  }


  public function round($roundId){

    $this->load->helper('url');
    $this->load->model('QuestionQueueModel');
    $this->load->model('QuestionModel');
    $this->load->model('RoundModel');
    
    $data = $this->loadNavData();
    $data['roundRow'] = $this->RoundModel->getRound($roundId);
    $data['questionqueues'] = $this->QuestionQueueModel->getQuestionsByRound($roundId);
    $data['questions'] = $this->QuestionModel->getQuestions();
    
    $this->load->view('admin_nav', $data);
    $this->load->view('admin_round',$data);
    $this->load->view('admin_footer');

  }

  public function newRound(){
  //set validation rules
            $this->form_validation->set_rules('roundName', 'roundName', 'required|is_unique[rounds.roundName]');
            
            $this->load->model('RoundModel');
            $roundName = $this->input->post("roundName");            
            $this->load->model('QuestionQueueModel');
            $data['qq'] = $this->QuestionQueueModel->getQuestionQueue();
        
           
      //run validation on form input
            if ($this->form_validation->run() == FALSE )
            {
            //validation fails
              $this->load->helper('url');
              $data = $this->loadNavData();
              $this->load->view('admin_nav', $data);
              $this->load->model('RoundModel');
              
              $this->load->view('admin_add_round');
              $this->load->view('admin_footer');
            }
            else
            {
              //Add Round
              $roundName = $this->input->post("roundName");
            
              
              $roundData = array(
                "roundName" => $roundName
                
                );
                        
              if ($this->RoundModel->insertRound($roundData) )
              {    
                  //getroundbyName

                  $roundId = $this->RoundModel->getRoundIdByName($roundName);     



              // roundAdded
                $this->session->set_flashdata('roundMsg',"<div class='alert alert-success text-center'>Round is succesfully added!
                  <a href='" . base_url('/Admin/Round') . "/" . $roundId . "'>Go to this round</a></div>");
                  redirect(base_url('/Admin/newRound'));
                
              }
              else
              {
                //error
                $this->session->set_flashdata('roundMsg','<div class="alert alert-danger text-center">Something went wrong!</div>');
                redirect(base_url('/Admin/newRound'));
              }
          }
  }

  public function dashboard(){



    $this->load->helper('url');
    $this->load->model('QuestionQueueModel');
    $this->load->model('StatusModel');
    $data = $this->loadNavData();

    $currRoundId = $this->StatusModel->getStatus(currentRoundStatusId);
    $currQuestionId = $this->StatusModel->getStatus(currentQuestionStatusId);
    $inRoundEnd = $this->StatusModel->getStatus(inRoundEndStatusId);
    $inQuizEnd = $this->StatusModel->getStatus(inQuizEndStatusId);
    $data['inQuizEnd'] = $inQuizEnd;

    if ($currRoundId == null){      
      $this->StatusModel->initQuiz();
    }

    
    if ($currRoundId == -1 && $currQuestionId == -1){
      $q = $this->QuestionQueueModel->QuestionZero();
      if (is_int($q)){
        $data['qId'] = -1;
        $data['rId'] = -1;        
      }
      else{
        $data['qId'] = $q->questionId;
        $data['rId'] = $q->roundId;
        $this->StatusModel->updateStatus(currentRoundStatusId,$q->roundId);
        $this->StatusModel->updateStatus(currentQuestionStatusId,$q->questionId);
      }
    }
    else{
      if($inQuizEnd){
        $data['qId'] = -1;
        $data['rId'] = -1;
      }
      else{
        if($inRoundEnd){
          $data['qId'] = -1;
          $data['rId'] = $currRoundId;          
        }
        else{
          $data['qId'] = $currQuestionId;
          $data['rId'] = $currRoundId;
        }
      }
    }
    

    $this->load->view('admin_nav', $data);
    $this->load->view('admin_dashboard', $data);
    $this->load->view('admin_footer');
  }

  function updateQuizStatus(){
    $this->load->model('QuestionQueueModel');
    $this->load->model('StatusModel');
    $currRoundId = $this->StatusModel->getStatus(currentRoundStatusId);
    $currQuestionId = $this->StatusModel->getStatus(currentQuestionStatusId);
    $inRoundEnd = $this->StatusModel->getStatus(inRoundEndStatusId);
    $inQuizEnd = $this->StatusModel->getStatus(inQuizEndStatusId);

    

    if($inQuizEnd){
      $currRoundId = -1;
      $currQuestionId = -1;
      $this->StatusModel->updateStatus(inQuizEndStatusId,0);
    }
    if ($currRoundId == -1 && $currQuestionId == -1){// should never happen unles quiz restart
      $q = $this->QuestionQueueModel->QuestionZero();
      $this->StatusModel->updateStatus(currentRoundStatusId,$q->roundId);
      $this->StatusModel->updateStatus(currentQuestionStatusId,$q->questionId);
    }
    else{
      $allQuizQuestions = $this->QuestionQueueModel->getQuestionQueue();
      foreach ($allQuizQuestions as $question){
        if ($question->questionId == $currQuestionId && $question->roundId == $currRoundId){
          $questionToAsk = $question;
          break;
        }
      }
      $index = array_search($question, $allQuizQuestions);
      $ammountOfQuestions = count($allQuizQuestions);
      if ($ammountOfQuestions == $index + 1){
        if ($inRoundEnd){
          $this->StatusModel->updateStatus(inQuizEndStatusId,1);
        }
        $this->StatusModel->updateStatus(inRoundEndStatusId,1);
      }
      else{
        $q = $allQuizQuestions[$index + 1];
        if ($question->roundId == $q->roundId || $inRoundEnd){
          $this->StatusModel->updateStatus(currentRoundStatusId,$q->roundId);
          $this->StatusModel->updateStatus(currentQuestionStatusId,$q->questionId);
          $this->StatusModel->updateStatus(inRoundEndStatusId,0);
        }
        else{
          $this->StatusModel->updateStatus(inRoundEndStatusId,1);
        }
      }    
    }
    echo $this->StatusModel->getStatus(currentRoundStatusId);
    echo $this->StatusModel->getStatus(currentQuestionStatusId);
    echo $this->StatusModel->getStatus(inRoundEndStatusId);
    echo $this->StatusModel->getStatus(inQuizEndStatusId);

  }
  public function restartQuiz(){

    $this->load->model('StatusModel');
    $this->StatusModel->initQuiz();
    $this->dashboard();
  }
  public function resetCounting(){

    $this->load->model('StatusModel');
    $this->StatusModel->initQuiz();
  }

  private function loadNavData(){
    $this->load->model('TeamModel');
    $this->load->model('RoundModel');
    
    $data['roundsnav'] = $this->RoundModel->getRounds();
    $data['teamsnav'] = $this->TeamModel->getTeamData();
    return $data;
  }
}