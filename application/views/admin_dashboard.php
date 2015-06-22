

<div class="container text-center">
	<button onclick="forward()">Forward</button>
</div>

<script src="<?php echo base_url();?>assets/js/socketio.js"></script>
<script>
	var socket = io.connect('<?php echo node_url?>', {'sync disconnect on unload': true });
	this.socket.on('Question', reloadPage());
  	this.socket.on('EndRound', reloadPage());

  	function reloadPage(){  		
  		location.reload();
  	}


	var curRoundId = <?php echo $currRoundId; ?>;
	var curQuestionId = <?php echo $currQuestionId; ?>;

	function forward(){
		if (curQuestionId == -1){
			socket.emit('requestEndRound', curRoundId);			
		}
		else{			
			socket.emit('requestQuestion', curRoundId,curQuestionId);
		}		
	}
	



	
	$(window).on('beforeunload', function(){
    	socket.close();
	});
</script>

      