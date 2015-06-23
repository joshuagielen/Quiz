<?php

class GenreModel extends CI_Model{

	function getGenres(){
		$query = $this->db->get('genres');
		return $query->result();
	}
	function getGenreNameById($genreId){
			$genreName = $this->db->select('genreName')
	                  ->get_where('genres', array('genreId' => $genreId))
	                  ->row()
	                  ->genreName;


			return $genreName;
	}
	
	
}
?>