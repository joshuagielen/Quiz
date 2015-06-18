 <div class="container text-center">

    <script>
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
    </script>


                <h1><?php echo $team->teamName;?></h1>

            


                <table class="table table-hover">
                <thead>
                <tr><th class="text-center">ID</th><th class="text-center">Naam</th><th class="text-center">Team ID</th><th class="text-center">Action</th></tr></thead>
                <tbody>
                    <?php
                        foreach ($players as $player) {
                            echo "<tr><td>" . $player->playerId . "</td><td>" . $player->playerName  . "</td><td>" . $player->teamId . 
                            "</td><td><a href='#' class='btn btn-lg' role='button'><span class='glyphicon glyphicon-edit'></span></a>    
                            <a href='http://facebook.com' class='btn btn-lg' role='button' onclick='return confirmation()'><span class='glyphicon glyphicon-remove'></span></a></td></tr>";  
                        }

                    ?>


                </tbody>

                </table>

        

            </div>






	</div>
