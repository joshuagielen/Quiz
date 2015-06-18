<?php

class TeamModel extends CI_Model{

	public function getData(){
		$query = $this->db->get('klanten');
		return $query->result();
	}

	public function insertData($data){
		$query = $this->db->insert('teams',$data);
		return true;
	}
	public function generate_password($length = 8, $complex=1) {
		$min = "abcdefghijklmnopqrstuvwxyz";
		$num = "0123456789";
		$maj = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$symb = "!@#$%^&*()_-=+;:,.?";
		$chars = $min;
		if ($complex >= 2) { $chars .= $num; }
		if ($complex >= 3) { $chars .= $maj; }
		if ($complex >= 4) { $chars .= $symb; }
		$password = substr( str_shuffle( $chars ), 0, $length );
		return $password;
	}

	public function role_exists($teamName)
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