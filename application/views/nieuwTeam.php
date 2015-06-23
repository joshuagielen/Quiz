<div class="col-xs-3 col-md-offset-5">
        	<h1>Nieuw Team</h1>
            <?php $attributes = array("class" => "form-horizontal", "name" => "contactform");
            echo form_open(base_url() . "Team/registerTeam", $attributes);?>



				<div class="form-group" >
            		<label for="teamName">Team name</label>
            		<input type="text" class="form-control" id="teamName" placeholder="Enter name of Team" name="teamName" value='<?php echo set_value('teamName'); ?>'>
            		<span class="text-danger"><?php echo form_error('teamName'); ?></span>
        		</div>
                <div class="form-group" >
                    <label for="teamColor">Team color</label>
                    <div class="input-group demo1">
                        <input type="text" value="" name="teamColor" class="form-control" />
                        <span class="input-group-addon"><i></i></span>
                    </div>
                </div>

        		<div id="players">
            		<div class="form-group" >
                		<label for="playerName">Player 1 name</label>
                		<input type="text" class="form-control" id="playerName" placeholder="Enter name of Player" name="playerName[]" value=''>
                		<span class='text-danger'></span>
            		</div>

        		</div>
				<a href="#"  onclick="add_fields();"  class="btn btn-lg" role="button"><span class="glyphicon glyphicon-plus-sign"></span></a></br>


				<input class="btn btn-lg" type="submit" value="Add team" name="addTeam">
			<?php echo form_close(); ?>
            <?php echo $this->session->flashdata('teamMsg'); ?>


			
			
       





        </div>
    </div>
</div>





 






	
	


</body>
</html>
