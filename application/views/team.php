<!DOCTYPE html>
<html>
<head>
	<title>Quiz</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="http://<?php echo base_url();?>assets/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="http://<?php echo base_url();?>assets/js/bootstrap.min.js"></script>



	


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
        <div class="col-xs-6">
            <h1>Login</h1>
        </div>
        <div class="col-xs-6">
        	<h1>Nieuw Team</h1>
            <?php $attributes = array("class" => "form-horizontal", "name" => "contactform");
            echo form_open("http://" . base_url() . "Team/index", $attributes);?>



				<div class="form-group" >
            		<label for="teamName">Team name</label>
            		<input type="text" class="form-control" id="teamName" placeholder="Enter name of Team" name="teamName" value='<?php echo set_value('teamName'); ?>'>
            		<span class="text-danger"><?php echo form_error('teamName'); ?></span>
        		</div>

        		<div id="players">
        		<div class="form-group" >
            		<label for="playerName">Player 1 name</label>
            		<input type="text" class="form-control" id="playerName" placeholder="Enter name of Player" name="playerName[]" value=''>
            		<span class='text-danger'></span>
        		</div>

        		</div>
				<a href="#"  onclick="add_fields();"  class="btn btn-lg" role="button"><span class="glyphicon glyphicon-plus-sign"></span></a></br>


				<input class="btn btn-lg" type="submit" value="Deelnemen aan Quiz">
			<?php echo form_close(); ?>
            <?php echo $this->session->flashdata('msg'); ?>


			
			
       





        </div>
    </div>
</div>





 






	
	


</body>
</html>
