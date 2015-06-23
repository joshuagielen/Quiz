<?php

class StatusModel extends CI_Model{

	function initQuiz(){
		$this->load->dbforge();
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
						    'statusId' => currentQuestionStatusId ,
						    'statusName' => 'currentQuestionId' ,
						    'statusValue' => '-1'
					   	),
					   	array(
						    'statusId' => currentRoundStatusId ,
						    'statusName' => 'currentRoundId' ,
						    'statusValue' => '-1'
					   	),
					   	array(
						    'statusId' => inRoundEndStatusId ,
						    'statusName' => 'inRoundEnd' ,
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

	function getStatus($statusId){
		return $this->db->get_where('status',array('statusId' => $statusId))->Row()->statusValue;
	}
}

?>