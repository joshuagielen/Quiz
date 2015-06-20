<div class="container text-center">
	<button onclick="requestQuestion()">Question</button>
	<button onclick="requestEndRound()">End round</button>
</div>

<script src="http://<?php echo base_url();?>assets/js/socketio.js"></script>
<script>
	var socket = io.connect('http://artemis:8080', {'sync disconnect on unload': true });
	
	function requestQuestion() {
		socket.emit('requestQuestion', 1,4);
		console.log("requestQuestion: " + 4);
	}
	function requestEndRound() {
		socket.emit('requestEndRound', 1);
		console.log("requestEndRound: " + 1);
	}
	$(window).on('beforeunload', function(){
    	socket.close();
	});
</script>