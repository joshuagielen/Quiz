<!DOCTYPE html>
<html>
<head>
	<title>Quiz</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


       <!-- CSS -->
<link rel="stylesheet" href="http://<?php echo base_url();?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="http://<?php echo base_url();?>assets/css/bootstrap-theme.min.css">
<link href="http://<?php echo base_url();?>assets/css/bootstrap-colorpicker.min.css" rel="stylesheet">

<!-- JavaScript -->
<script src="http://<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="http://<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="http://<?php echo base_url();?>assets/js/bootstrap-colorpicker.min.js"></script>
<script src="http://<?php echo base_url();?>assets/js/socketio.js"></script>

<script>

	askQuestion = function(rId, qId){
		console.log("question: " + qId + "\nround: " + rId);
	};
	endRound = function(rId){
		console.log("End of round: " + rId);
	};

	socket = io.connect('http://artemis:8080', {'sync disconnect on unload': true });

	this.socket.on('Question', askQuestion);
	this.socket.on('EndRound', endRound);



	
</script>


    
	
</head>
<body>
	<nav></nav>
	<div class="container text-center">


	<h1>Quiz start binnen enkele ogenblikken</h1>

<?php echo "<a href='http://" . base_url() . "Quiz/logOut/'" . "class='btn btn-lg' role='button'><span class='glyphicon glyphicon-log-out'></span></a>"; ?>



	



		

</div>

</body>
</html>
