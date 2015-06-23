<?php

class AnswerModel extends CI_Model{


	
	function insertAnswer($data){
		$query = $this->db->insert('answers', $data);
		return true;
	}
	

	
}
?>