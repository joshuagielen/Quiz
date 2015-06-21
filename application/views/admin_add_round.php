


<div class="container text-center">





    <h1>New Round</h1>
            <?php $attributes = array("class" => "form-horizontal", "name" => "contactform");
            echo form_open("http://" . base_url() . "Admin/newRound", $attributes);?>



                <div class="form-group" >
                    <label for="roundName">Round name</label>
                    <input type="text" class="form-control" id="roundName" placeholder="Enter name of Round" name="roundName" value='<?php echo set_value('roundName'); ?>'>
                    <span class="text-danger"><?php echo form_error('roundName'); ?></span>
                </div>
                

                

                


                <input class="btn btn-lg" type="submit" value="Add Round" name="addTeam">
            <?php echo form_close(); ?>
            <?php echo $this->session->flashdata('roundMsg'); ?>


                 





        
    





	</div>