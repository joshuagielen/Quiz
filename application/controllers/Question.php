<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($rId, $qId)
	{
		$this->load->helper('url');
		$this->load->model('QuestionModel');
		$this->load->model('RoundModel');

		$questionData = $this->QuestionModel->getQuestionById($qId);
		$roundData = $this->RoundModel->getRoundById($rId);

		$data['questionData'] = $questionData;
		$data['roundData'] = $roundData;

		$this->load->view('quiz_nav', $data);
		$this->load->view('question', $data);
	}
	public function summary($rId)
	{
		$this->load->helper('url');
		$this->load->model('RoundModel');
		$roundData = $this->RoundModel->getRoundById($rId);
		$data['roundData'] = $roundData;

		$this->load->view('quiz_nav');
		$this->load->view('questionSummary', $data);
	}
}
