<?php

class RoundModel extends CI_Model{


	function getRoundById($rId){
		$query = $this->db->get_where('rounds', array('roundId' => $rId))->row();
		return $query;
	}
}
?>