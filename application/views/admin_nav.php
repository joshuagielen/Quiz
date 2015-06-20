<!DOCTYPE html>
<html>
<head>
	<title>QuizAdmin</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="administration view for the quiz framework">
    <meta name="author" content="Kobe Housen">
    <meta name="author" content="Joshua Gielen">

    <link href="http://<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="http://<?php echo base_url();?>assets/css/sb-admin.css" rel="stylesheet" type="text/css">
    <link href="http://<?php echo base_url();?>assets/css/plugins/morris.css" rel="stylesheet" type="text/css">
    <link href="http://<?php echo base_url();?>assets/css/bootstrap-theme.min.css" rel="stylesheet">

    


	
</head>
<body>
	<div id="wrapper">
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
            	<a class="navbar-brand" href="http://<?php echo base_url();?>Admin">Quiz Admin</a>
                <?php echo "<a class='navbar-brand' href='http://" . base_url() . "Admin/logOut/'" . "class='btn btn-lg' role='button'><span class='glyphicon glyphicon-log-out'></span></a>"; ?>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
            	<ul class="nav navbar-nav side-nav">
                    <li class="active">                    
                        <a href="http://<?php echo base_url();?>Admin/dashBoard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#rounds"><i class="fa fa-fw fa-arrows-v"></i> Rounds <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="rounds" class="collapse">
                            <li>
                                <a href="#">Round1</a>
                            </li>
                            <li>
                                <a href="#">Round2</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="http://<?php echo base_url();?>Admin/Questions"><i class="fa fa-fw fa-bar-chart-o"></i> Questions</a>
                    </li>                   
                    <li>
                        <a href="tables.html"><i class="fa fa-fw fa-table"></i> Scores</a>
                    </li>
                    <li>
                        <a href="tables.html"><i class="fa fa-fw fa-table"></i> Clients</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#teams"><i class="fa fa-fw fa-arrows-v"></i> Teams <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="teams" class="collapse">


                            <?php
                              foreach ($teamsnav as $team) {
                                    echo "<li><a href='http://" . base_url() . "Admin/teams/" . $team->teamId . "'>" . $team->teamName . "</a></li>";  
                            }


                            ?>



                            <li>
                                <a href="<?php echo "http://" . base_url() . "Admin/newTeam"?>">New team</a>
                            </li>
                            
                        </ul>
                    </li>
                    
                </ul>
            </div>
        </nav>


       