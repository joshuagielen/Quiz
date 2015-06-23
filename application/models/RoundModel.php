<?php

class RoundModel extends CI_Model{


	function updateRound($roundId, $data){
		$query = $this->db->where('roundId', $roundId)->update('rounds', $data);
		return true;
	}
	function deleteRound($roundId){
		$query = $this->db->delete('rounds', array('roundId' => $roundId)); 
		return true;
	}
	function insertRound($data){
		$query = $this->db->insert('rounds', $data);
		return true;
	}
	function getRounds(){
		$this->db->order_by("roundSequenceNumber", "asc"); 
		$query = $this->db->get('rounds');
		return $query->result();
	}

	function getRound($roundId){
			return $this->db->get_where('rounds', array('roundId' => $roundId))->row();
	}	

	function getRoundById($rId){
		$query = $this->db->get_where('rounds', array('roundId' => $rId));
		return $query->row();
	}

	function getRoundIdByName($roundName){
		$roundId = $this->db->select('roundId')
                  ->get_where('rounds', array('roundName' => $roundName))
                  ->row()
                  ->roundId;
		return $roundId;
	}

	function getRoundBySequenceNumber($seqNr){

		$query = $this->db->get_where('rounds', array('roundSequenceNumber' => $seqNr));

		$rowCount = $query->num_rows();

		if ($rowCount == 1){
			return $query->row()->roundId;
		}
		else if ($rowCount > 1){
			show_error('multiple rounds with the same sequence number!');
			//$this->fixSequenceError();
			return null;			
		}
		else /*if ($rowCound < 1)*/{
			return -1;
		}
	}


	function fixSequenceError(){
		$rounds = $this->getRounds();
		$normalRoundSeq = 0;
		foreach ($rounds as $round){
			if ($round->roundSequenceNumber != $normalRoundSeq){
				$data =	array(
							'roundSequenceNumber' => $normalRoundSeq
						);

				$this->updateRound($round->roundId, $data);
			}
			$normalRoundSeq++;
		}
		return true;
	}

	


}

?>