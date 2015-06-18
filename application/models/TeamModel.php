<?php

class TeamModel extends CI_Model{

	function getId($teamName){
		$teamId = $this->db->select('teamId')
                  ->get_where('teams', array('teamName' => $teamName))
                  ->row()
                  ->teamId;


		return $teamId;
	}

	function getData(){
		$query = $this->db->get('teams');
		return $query->result();
	}

	function insertData($table, $data){
		$query = $this->db->insert($table, $data);
		return true;
	}
	function generate_password($length = 4) {

		$min = "0123456789";

		$chars = $min;

		$password = substr( str_shuffle( $chars ), 0, $length );
		return $password;
	}

	function role_exists($teamName)
	{
    $this->db->where('teamName',$teamName);
    $query = $this->db->get('teams');
    if ($query->num_rows() > 0){
        return false;
    }
    else{
        return true;
    }
}

	


}
?>