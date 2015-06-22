<?php

class StatusModel extends CI_Model{

	function initQuiz(){
		$this->dbforge->drop_table('status');
		$this->dbforge->create_table('status');
		//set stati to innitial values
		//have swag

	}


	function updateStatus(status, value){


		return true;
	}
}

?>