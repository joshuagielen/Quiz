<?php

	class PlayerModel extends CI_Model{


		function deletePlayer($playerId){
			$query = $this->db->delete('players', array('playerId' => $playerId)); 
			return true;
		}
		function updatePlayer($playerId, $data){
			$query = $this->db->where('playerId', $playerId)->update('players', $data);
			return true;
		}	

		/*function getId($teamName){
			$teamId = $this->db->select('teamId')
	                  ->get_where('teams', array('teamName' => $teamName))
	                  ->row()
	                  ->teamId;


			return $teamId;
		}*/
		
		function getData($table){
			$query = $this->db->get($table);
			return $query->result();
		}

		function getPlayersById($teamId){
			$query = $this->db->get_where('players', array('teamId' => $teamId));
			return $query->result();
		}
		

		function insertPlayer($data){
			$query = $this->db->insert('players', $data);
			return true;
		}
		/*
		function getPlayersByTeamName($teamName);

			$teamId = $this->getId($teamName);
			$query = $this->db->get_where('players', array('teamId' => $teamId));
			return $query->result();
		}*/
	}
?>