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
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-theme.min.css">
<link href="<?php echo base_url();?>assets/css/bootstrap-colorpicker.min.css" rel="stylesheet">

<!-- JavaScript -->
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

<script src="<?php echo base_url();?>assets/js/bootstrap-colorpicker.min.js"></script>

<!-- redirect for next question/end round -->
<script src="<?php echo base_url();?>assets/js/socketio.js"></script>
<script>
  askQuestion = function(rId, qId){
    console.log("question: " + qId + "\nround: " + rId);
    window.location = "<?php echo base_url();?>question/index/" + rId + "/" + qId;
  };
  endRound = function(rId){
    console.log("End of round: " + rId);    
    window.location = "<?php echo base_url();?>question/summary/" + rId;
  };

  socket = io.connect('<?php echo node_url?>', {'sync disconnect on unload': true });


  this.socket.on('Question', askQuestion);
  this.socket.on('EndRound', endRound);
</script>


    
  
</head>
<body>

<nav class="navbar navbar-default">
  <div id="teamColor" class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Quiz</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      
      <ul class="nav navbar-nav navbar-right">
        <li><?php echo "<a href='" . base_url() . "Quiz/logOut/'" . "class='btn btn-lg' role='button'><span class='glyphicon glyphicon-log-out'></span></a>"; ?></li>
        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>