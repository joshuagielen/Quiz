



<script src="<?php echo base_url();?>assets/js/socketio.js"></script>
<script>
	var socket = io.connect('<?php echo node_url?>', {'sync disconnect on unload': true });
	this.socket.on('Question', reloadPage);
  	this.socket.on('EndRound', reloadPage);

  	function reloadPage(){
  		location.reload();
  	}


	var curRoundId = <?php echo $rId; ?>;
	var curQuestionId = <?php echo $qId; ?>;	

	function forward(){
		if (curQuestionId == -1){
			socket.emit('requestEndRound', curRoundId);
		}
		else{			
			socket.emit('requestQuestion', curRoundId,curQuestionId);
		}
	}
	function restart(){		
    	window.location = "<?php echo base_url();?>admin/restartQuiz";
	}
	
	
</script>

<div class="container text-center">
	<button id="btnNext" onclick="forward()">Forward</button>
	<button id="btnRestart" onclick="restart()">RestartQuiz</button>
</div>


<script>

if(curRoundId == -1 && curQuestionId == -1){
	$('#btnNext').hide();
	$('#btnRestart').show();
	alert('This is the end af the quiz! Hope you had fun!');
}
else{
	$('#btnNext').show();
	$('#btnRestart').hide();
}
</script>