



<script src="<?php echo base_url();?>assets/js/socketio.js"></script>
<script>
	var socket = io.connect('<?php echo node_url?>', {'sync disconnect on unload': true });

	this.socket.on('Question', reloadPage);
  	this.socket.on('EndRound', reloadPage);

  	function reloadPage(){
    	window.location = "<?php echo base_url();?>admin/dashboard";
    }

    var curRoundId = "";
    var curQuestionId = "";

    <?php
    	if(isset($qzero)) $e = "true";    	
    	else $e = "false";
    ?>

    if (<?php echo $e;?>){
    	curRoundId = -1;
    	curQuestionId = -1;
    }
    else{
    	var curRoundId = <?php echo $rId; ?>;
		var curQuestionId = <?php echo $qId; ?>;
    }

		

	function forward(){

		$.ajax({url:'<?php echo base_url() ?>admin/updateQuizStatus',
            success:function(data){
            	if (curQuestionId == -1){
					socket.emit('requestEndRound', curRoundId);
				}
				else{
					socket.emit('requestQuestion', curRoundId,curQuestionId);
		}
            },
            error: function(a, b, c) {
              alert(a + ' ' + b + ' ' + c);
            }
        });
		

	}
	function resetCounting(){

		$.ajax({url:'<?php echo base_url() ?>admin/resetCounting',
            success:function(data){
            	alert("counting reset!");
            },
            error: function(a, b, c) {
            	alert(a + ' ' + b + ' ' + c);
            }
        });
		return "ok";

	}


	function restart(){		
    	window.location = "<?php echo base_url();?>admin/restartQuiz";
	}
	
	
</script>


<div id="test" class="container text-center">
	<button id="btnNext" onclick="forward()">Forward</button>
	<button id="btnRestart" onclick="restart()">RestartQuiz</button>
</div>


<script>

if(curRoundId == -1 && curQuestionId == -1){
	if(<?php echo $inQuizEnd; ?>){
		$('#btnNext').hide();
	$('#btnRestart').show();
	alert('This is the end af the quiz! Hope you had fun!');
	}
	else{
		alert('please create a round and put a question in it');
	}
	
}
else{
	$('#btnNext').show();
	$('#btnRestart').hide();
}
</script>
