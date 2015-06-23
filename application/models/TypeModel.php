<?php

class TypeModel extends CI_Model{

	function getTypes(){
		$query = $this->db->get('types');
		return $query->result();
	}
	function getTypeNameById($typeId){
			$typeName = $this->db->select('typeName')
	                  ->get_where('types', array('typeId' => $typeId))
	                  ->row()
	                  ->typeName;


			return $typeName;
	}
	
	
}
?>