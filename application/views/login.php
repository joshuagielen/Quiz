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
<script src="http://<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="http://<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="http://<?php echo base_url();?>assets/js/bootstrap-colorpicker.min.js"></script>
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

	<h1>Team samenstellen</h1>

	<div class="container">
    <div class="row">
        <div class="col-xs-3">
            <h1>Log In</h1>
            <?php $attributes = array("class" => "form-horizontal", "name" => "contactform");
            echo form_open("http://" . base_url() . "Team/loginTeam", $attributes);?>
            


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
        