<div class="row">
    <div class="col-xs-6">
      <?php
        echo "<ul id='roundList' class='list-group text-left sortable'> ";
        $noSeqRounds = array();
        $seqRounds = array();

        foreach ($roundsnav as $round){
        	if ($round->roundSequenceNumber == Null){
        		array_push($noSeqRounds,$round);
        	}
        	else {
        		$seqRounds[$round->roundSequenceNumber] = $round;
        	}
        }


        
        
        for ($i=0;$i<count($seqRounds);$i++){
        	echo "<li class='list-group-item' id='" . $seqRounds[$i]->roundId . "'>" . $seqRounds[$i]->roundName  . "</li>";
        }
        for ($i=0;$i<count($noSeqRounds);$i++){
        	echo "<li class='list-group-item' id='" . $noSeqRounds[$i]->roundId . "'>" . $noSeqRounds[$i]->roundName  . "</li>";
        }
        
        echo "</ul>";
        ?>



    </div>
</div>
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
<script src="http://<?php echo base_url();?>assets/js/html.sortable.src.js"></script>
      <script>
        $(".sortable").sortable({
          connectWith: '.js-connected'
        }).bind('sortupdate', function(e, ui) {
          var quizRoundAmount = document.getElementById("roundList").getElementsByTagName("li").length;
          var data = new Array();
          for (i = 0; i < quizRoundAmount; i++) {
            data[i] = $('#roundList li')[i].id;
          }
          
          var p = {};
          p['rounds'] = data;




          $.ajax({
            type:'POST',
            url:'http://<?php echo base_url() ?>Rounds/Update',
            data:p,
            success:function(data){
            },
            error: function(a, b, c) {
              alert(a + ' ' + b + ' ' + c);
            }
        });
        });
      </script>
      