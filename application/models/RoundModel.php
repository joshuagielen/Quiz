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
		$query = $this->db->get('rounds');
		return $query->result();
	}

	function getRound($roundId){
			return $this->db->get_where('rounds', array('roundId' => $roundId))->row();
	}	

	function getRoundById($rId){
		$query = $this->db->get_where('rounds', array('roundId' => $rId))->row();
		return $query;
	}

}

?>