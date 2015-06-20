<div class="container text-center">

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

    <h1>Nieuw Team</h1>
            <?php $attributes = array("class" => "form-horizontal", "name" => "contactform");
            echo form_open("http://" . base_url() . "Admin/addNewTeam", $attributes);?>



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


                <input class="btn btn-lg" type="submit" value="Team toevoegen">
            <?php echo form_close(); ?>
            <?php echo $this->session->flashdata('msg'); ?>


                 





        
    





	</div>