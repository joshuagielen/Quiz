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

		$data = 	array(
					   	array(
						    'statusId' => $currentQuestionStatusId ,
						    'statusName' => 'currentQuestion' ,
						    'statusValue' => '0'
					   	),
					   	array(
						    'statusId' => $currentRoundStatusId ,
						    'statusName' => 'currentRound' ,
						    'statusValue' => '0'
					   	)
					);

		$this->db->insert_batch('status', $data);

	}

	function updateStatus($statusId, $value){
		$data = array(	               
	               'statusValue' => $value
        		);

		$this->db->where('statusId', $statusId);
		$this->db->update('status', $data);
	}
}

?>