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
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-colorpicker.min.js"></script>
<script>
    $(function(){
        $('.demo1').colorpicker();
    });
</script>



	


    <script>

        var player = 1;
        function add_fields() {
            player++;
            var objTo = document.getElementById('players')
            var divtest = document.createElement("div");
            divtest.innerHTML = '<div class="form-group" ><label for="playerName">Player ' + player + ' name</label><input type="text" class="form-control" id="playerName" placeholder="Enter name of Player" name="playerName[]" value=""><span class="text-danger"></span></div>';
            
            objTo.appendChild(divtest)
        }



    </script>
	
</head>
<body>
    <nav class="navbar navbar-default">
  <div class="container-fluid">
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
        <li><?php echo "<a href='" . base_url() . "Admin'" . "class='btn btn-lg' role='button'><span class='glyphicon glyphicon-wrench'></span></a>"; ?></li>
        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

	

	<div class="container">

    <div class="row">
        <div class="col-xs-3">
            <h1>Log In</h1>
            <?php $attributes = array("class" => "form-horizontal", "name" => "contactform");
            echo form_open(base_url() . "Team/loginTeam", $attributes);?>
            


                <div class="form-group" >
                    <label for="loginTeamName">Team name</label>
                    <input type="text" class="form-control" id="loginTeamName" placeholder="Enter name of Team" name="loginTeamName" value='<?php echo set_value('loginTeamName'); ?>'>
                    <span class="text-danger"><?php echo form_error('loginTeamName'); ?></span>
                </div>
                 <div class="form-group" >
                    <label for="loginTeamPassword">Team password</label>
                    <input type="password" class="form-control" id="loginTeamPassword" placeholder="Enter password of Team" name="loginTeamPassword" value='<?php echo set_value('loginTeamPassword'); ?>'>
                    <span class="text-danger"><?php echo form_error('loginTeamPassword'); ?></span>
                </div>


                <input class="btn btn-lg" type="submit" value="Login team" name="loginTeam">
            <?php echo form_close(); ?>
            <?php echo $this->session->flashdata('loginMsg'); ?>
        </div>
        