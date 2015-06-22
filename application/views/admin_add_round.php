


<div class="container text-center">
<div class="row">
    <div class="col-xs-6">
      <?php
        echo "<ul id='roundList' class='list-group text-left sortable'> ";
        $noSeqRounds = array();
        $seqRounds = array();

        foreach ($roundsnav as $round){
            if ($round->roundSequenceNumber == Null){
                array_push($noSeqRounds,$round);
            }
            else {
                $seqRounds[$round->roundSequenceNumber] = $round;
            }
        }


        
        
        for ($i=0;$i<count($seqRounds);$i++){
            echo "<li class='list-group-item' id='" . $seqRounds[$i]->roundId . "'>" . $seqRounds[$i]->roundName  . "</li>";
        }
        for ($i=0;$i<count($noSeqRounds);$i++){
            echo "<li class='list-group-item' id='" . $noSeqRounds[$i]->roundId . "'>" . $noSeqRounds[$i]->roundName  . "</li>";
        }
        
        echo "</ul>";
        ?>



    </div>
</div>
<script src="<?php echo base_url();?>assets/js/html.sortable.src.js"></script>
      <script>
        $(".sortable").sortable({
          connectWith: '.js-connected'
        }).bind('sortupdate', function(e, ui) {
          var quizRoundAmount = document.getElementById("roundList").getElementsByTagName("li").length;
          var data = new Array();
          for (i = 0; i < quizRoundAmount; i++) {
            data[i] = $('#roundList li')[i].id;
          }
          
          var p = {};
          p['rounds'] = data;




          $.ajax({
            type:'POST',
            url:'<?php echo base_url() ?>Rounds/Update',
            data:p,
            success:function(data){
            },
            error: function(a, b, c) {
              alert(a + ' ' + b + ' ' + c);
            }
        });
        });
      </script>





    <h1>New Round</h1>
            <?php $attributes = array("class" => "form-horizontal", "name" => "contactform");
            echo form_open(base_url() . "Admin/newRound", $attributes);?>



                <div class="form-group" >
                    <label for="roundName">Round name</label>
                    <input type="text" class="form-control" id="roundName" placeholder="Enter name of Round" name="roundName" value='<?php echo set_value('roundName'); ?>'>
                    <span class="text-danger"><?php echo form_error('roundName'); ?></span>
                </div>
                

                

                


                <input class="btn btn-lg" type="submit" value="Add Round" name="addTeam">
            <?php echo form_close(); ?>
            <?php echo $this->session->flashdata('roundMsg'); ?>


                 





        
    





	</div>