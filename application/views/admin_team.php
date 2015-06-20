 <div class="container text-center">


    <!-- CSS & JQuery for popup login and register pane -->
    <link rel="stylesheet" href="http://<?php echo base_url();?>assets/css/reveal.css">
    <script src="http://<?php echo base_url();?>assets/js/jquery-1.4.4.min.js" type="text/javascript"></script>
    <script src="http://<?php echo base_url();?>assets/js/jquery.reveal.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('a').on('click',function(){
                var aID = $(this).attr('href');
                var elem = $(''+aID).html();
                
                $('.target').html(elem);
            });
        });


        function confirmation()
        {
           var r=confirm("are you sure to delete?")
           if (r==true)
          {
            return true;
          }
          else
          {
           return false;
          }
        }

        function submitenter(myfield,e)
        {
            var keycode;
            if (window.event) keycode = window.event.keyCode;
            else if (e) keycode = e.which;
            else return true;

            if (keycode == 13)
               {
               myfield.form.submit();
               return false;
               }
            else
               return true;
        }
    </script>



   <div class="page-header">
    <?php echo "<h1>" . $teams->teamName . "<a href='#team" . $teams->teamId . "'class='btn btn-lg' role='button' data-reveal-id='myModal'><span class='glyphicon glyphicon-edit'></span></a>
                <a href='http://" . base_url() . "admin/deleteTeam/" .  $teams->teamId ." ' class='btn btn-lg' role='button' onclick='return confirmation()'><span class='glyphicon glyphicon-remove'></span></a></h1>";?>

 <h2>Password: <?php echo $teams->teamPassword?></h2>
 <canvas id="myCanvas" width="100" height="50" style="background-color:<?php echo $teams->teamColor?>"></canvas>
</div>

                
                


                <table class="table table-bordered">
                <thead>
                <tr><th class="text-center">ID</th><th class="text-center">Name</th><th class="text-center">Team ID</th><th class="text-center">Action</th></tr></thead>
                <tbody>
                    <?php
                        foreach ($players as $player) {
                            echo "<tr><td>" . $player->playerId . "</td><td>" . $player->playerName  . "</td><td>" . $player->teamId . 
                            "</td><td>
                            <a href='#player" . $player->playerId . "'class='btn btn-lg' role='button' data-reveal-id='myModal'>
                            <span class='glyphicon glyphicon-edit'></span></a> 

                            <a href='http://" . base_url() . "admin/deletePlayer/" .  $player->playerId . "/". $teams->teamId ." ' class='btn btn-lg' role='button' onclick='return confirmation()'><span class='glyphicon glyphicon-remove'></span></a></td></tr>";  
                        }

                    ?>
                <tr><td></td><td>
                        <form method='post' action='http://<?php echo base_url()?>admin/addPlayer'>
                           <input type='hidden' name='teamId' value='<?php echo $teams->teamId ?>' />
                           <input type="text" class="form-control" id="playerName" placeholder="Enter name of Player and press enter" name="playerName" onKeyPress="return submitenter(this,event)">
                        </form>
                        



                    </td></tr>
                

                    
                </tbody>

                </table>



                <div class="target">


                </div>


                    <?php

                        foreach ($players as $player) {

                            echo "<div id='player". $player->playerId ."'><div id='myModal' class='reveal-modal'>";
                            echo "<form method='post' action='http://" . base_url() . "admin/updatePlayer'>";
                            
                            echo "<input type='hidden' name='playerId' value='" . $player->playerId . "' />";
                             echo "<input type='hidden' name='teamId' value='" . $teams->teamId . "' />";
                            

                             echo "<div class='form-group' >
                                    <label for='playerName'>Player name</label>
                                    <input type='text' class='form-control' id='playerName' placeholder='Enter name of Player' name='newPlayerName' autofocus value='". $player->playerName ."'>
                                 </div>";

                            echo "<input type='submit' value='change player' name='change' />";
                            echo "</form>";
                            echo "<a class='close-reveal-modal'>&#215;</a></div></div>";  
                        }

                        

                    ?>

                    <div id='team<?php echo $teams->teamId ?>'><div id='myModal' class='reveal-modal'>"
                        <form method='post' action='http://<?php echo base_url()?>admin/updateTeam'>
                       <input type='hidden' name='teamId' value='<?php echo $teams->teamId ?>' />                        

                        <div class='form-group' >
                                    <label for='newTeamName'>New team name</label>
                                    <input type='text' class='form-control' id='TeamName' placeholder='Enter name of Team' name='newTeamName' autofocus value='<?php echo$teams->teamName?>'>
                                 </div>

                        <input type='submit' value='change team' name='change' />
                        </form>
                        <a class='close-reveal-modal'>&#215;</a></div>
                    </div>
                 





        
    





	</div>
