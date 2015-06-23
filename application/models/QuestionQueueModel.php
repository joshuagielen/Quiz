<?php

class QuestionQueueModel extends CI_Model{


	function getQuestionsByRound($roundId){
		
			$this->db->select('questions.questionValue AS question, q.sequenceNumber AS sequenceNumber, q.questionId AS questionId ');
		    $this->db->from('questionqueue AS q');
		    $this->db->join('questions', 'questions.questionId=q.questionId');
		    $this->db->where('roundId',$roundId);
			$this->db->order_by("q.sequenceNumber", "asc"); 
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

	function getQuestionQueue(){
		$this->db->select('q.questionId AS questionId, q.roundId AS roundId, q.sequenceNumber, r.roundSequenceNumber AS roundSequenceNumber');
	    $this->db->from('questionQueue AS q');
	    $this->db->join('rounds AS r', 'r.roundId=q.roundId');
	    $this->db->order_by("r.roundSequenceNumber", "asc");
		$this->db->order_by("q.sequenceNumber", "asc"); 
	    $query=$this->db->get();

	    return $query->result();

	}

	function getQuestionQueueForRound($roundSequenceNumber){
		$this->db->select('q.questionId AS questionId, q.roundId AS roundId, q.sequenceNumber');
	    $this->db->from('questionQueue AS q');
	    $this->db->join('rounds AS r', 'r.roundId=q.roundId');
	    $this->db->where('roundSequenceNumber',$roundSequenceNumber);
	    $this->db->order_by("r.roundSequenceNumber", "asc");
		$this->db->order_by("q.sequenceNumber", "asc"); 
	    $query=$this->db->get();
	    return $query->result();

	}

	function questionZero(){		
		$this->db->select('q.questionId as questionId, r.roundId as roundId');
		$this->db->from('questionQueue as q');	
	    $this->db->join('rounds AS r', 'r.roundId=q.roundId');
		$this->db->where('q.sequenceNumber', 0);
		$this->db->where('r.roundSequenceNumber', 0);
		$query = $this->db->get();

		$rowCount = $query->num_rows();

		if ($rowCount == 1){
			return $query->Row();
		}
		else if ($rowCount > 1){
			show_error('multiple questionZero\'s');
			//$this->fixSequenceError();
			return -2;
		}
		else /*if ($rowCound < 1)*/{
			return -1;
		}
	}

	

	


	


}
?>





