<?php

class StatusModel extends CI_Model{

	function initQuiz(){
		$this->dbforge->drop_table('status');
		$fields = 	array(
                        'statusId' => 		array(
                                                'type' => 'INT',                                                 
                                        	),

                        'statusName' =>		array(
                        						'type' => 'VARCHAR',
                        						'constraint' => '255'
                        					),

                        'statusValue' =>	array(
                        						'type' => 'VARCHAR',
                        						'constraint' => '255'
                        					)
                	);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('statusId', TRUE);
		$this->dbforge->create_table('status');
		

	}


	function updateStatus(status, value){


		return true;
	}
}

?>