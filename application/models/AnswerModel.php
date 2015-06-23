<?php

class AnswerModel extends CI_Model{

	function deleteAnswerByQuestionId($questionId){
		$query = $this->db->delete('answers', array('questionId' => $questionId)); 
		return true;
	}


	
	function insertAnswer($data){
		$query = $this->db->insert('answers', $data);
		return true;
	}

	function getAnswersByQuestionId($questionId){
		$query = $this->db->get_where('answers', array('questionId' => $questionId));
			return $query->result();
	}

	function getAllAnswers(){
		return $this->db->get('answers')->result();
	}

	function updateAnswer($questionId,$answerId,$data){
		$query = $this->db->where(array('questionId'=>$questionId, 'answerId'=>$answerId))->update('answers', $data);
		return true;
	}

	

	
}
?>