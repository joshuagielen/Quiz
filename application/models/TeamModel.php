<?php

	class TeamModel extends CI_Model{


		
		function deleteTeam($teamId){
			$query = $this->db->delete('teams', array('teamId' => $teamId)); 
			return true;
		}


		function updateTeam($teamId, $data){
			$query = $this->db->where('teamId', $teamId)->update('teams', $data);
			return true;
		}

		function getTeamId($teamName){
			$teamId = $this->db->select('teamId')
	                  ->get_where('teams', array('teamName' => $teamName))
	                  ->row()
	                  ->teamId;


			return $teamId;
		}

		function getTeamColor($teamName){
			$teamColor = $this->db->select('teamColor')
	                  ->get_where('teams', array('teamName' => $teamName))
	                  ->row()
	                  ->teamColor;


			return $teamColor;
		}
		
		function getTeamData(){
			$query = $this->db->get('teams');
			return $query->result();
		}


		function getTeamById($teamId){
			return $this->db->get_where('teams', array('teamId' => $teamId))->row();
		}

		function insertTeam($data){
			$query = $this->db->insert('teams', $data);
			return true;
		}
		function generate_password($length = 4) {

			$chars = "0123456789";

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