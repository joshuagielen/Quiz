	
	
	<div class="container text-center">
		<div class="row">
  			<div class="col-md-2">
  				<h4>Team members</h4>
  				<?php
					echo "<ul class='list-group'> ";
					foreach ($players as $player) {
				        echo "<li class='list-group-item'>" . $player->playerName  . "</li>";
				    }
				    echo "</ul>";
				?>
  			</div>
  			<div class="col-md-8">
  				<div class="jumbotron">
		  			<h1>Hello, <?php echo $teamInfo['teamName']?>!</h1>
		  			<p>Wait until the quizmaster starts the quizz!</p>
		  			<p><a class="btn btn-primary btn-lg" href="#" role="button">Show your competitors</a></p>
				</div>
  			</div>
  			<div class="col-md-2">
  				
  			</div>
  		</div>


		



	
		



		

</div>

</body>
</html>
