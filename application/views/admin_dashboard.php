

<div class="container text-center">
	<button onclick="forward()">Forward</button>
</div>

<script src="<?php echo base_url();?>assets/js/socketio.js"></script>
<script>
	var socket = io.connect('<?php echo node_url?>', {'sync disconnect on unload': true });
	var questionSequence = 0;
	var curRoundId = 0;
	var jsonQqArray = '<?php echo json_encode($qq); ?>';
	var fullQuestionSequence = JSON.parse(jsonQqArray);

	function forward(){
		$('.sortable').sortable('disable');
		if (fullQuestionSequence[questionSequence]['roundId'] == curRoundId){
			requestQuestion(curRoundId, fullQuestionSequence[questionSequence]['questionId'])
			questionSequence++;
		}
		else{
			requestEndRound(curRoundId);
			curRoundId = fullQuestionSequence[questionSequence]['roundId'];
		}
		
	}




	
	$(window).on('beforeunload', function(){
    	socket.close();
	});
</script>

      