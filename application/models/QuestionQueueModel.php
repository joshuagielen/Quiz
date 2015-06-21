<?php

class QuestionQueueModel extends CI_Model{


	function getQuestionsByRound($roundId){
		
			$this->db->select('questions.questionValue AS question, q.sequenceNumber AS sequenceNumber, q.questionId AS questionId ');
		    $this->db->from('questionqueue AS q');
		    $this->db->join('questions', 'questions.questionId=q.questionId');
		    $this->db->where('roundId',$roundId);
		    $query=$this->db->get();

		   




		    return $query->result();
			
			
	}
	function updateQuestionQueue($questionSequenceArray, $rId){

		$data["roundId"] = $rId;
		$this->db->delete('questionQueue', $data);

		for ($i=0;$i<count($questionSequenceArray);$i++){
			echo $data["sequenceNumber"] = $i;
			echo $data["questionId"] = $questionSequenceArray[$i];
			$this->db->insert('questionQueue', $data);
		}		
		
	}
	

	


	


}
?>





