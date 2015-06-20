<?php

class QuestionModel extends CI_Model{


	function updateQuestion($questionId, $data){
		$query = $this->db->where('questionId', $questionId)->update('questions', $data);
		return true;
	}
	function deleteQuestion($questionId){
		$query = $this->db->delete('questions', array('questionId' => $questionId)); 
		return true;
	}
	function insertQuestion($data){
		$query = $this->db->insert('questions', $data);
		return true;
	}
	function getQuestions(){
		$query = $this->db->get('questions');
		return $query->result();
	}
	

	


	


}
?>