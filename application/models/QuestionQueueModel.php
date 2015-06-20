<?php

class QuestionQueueModel extends CI_Model{


	function getQuestionsByRound($roundId){
		
			$this->db->select('questions.questionValue AS question, q.sequenceNumber AS sequenceNumber ');
		    $this->db->from('questionqueue AS q');
		    $this->db->join('questions', 'questions.questionId=q.questionId');
		    $this->db->where('roundId',$roundId);
		    $query=$this->db->get();

		   




		    return $query->result();
			
			
	}
	

	


	


}
?>





