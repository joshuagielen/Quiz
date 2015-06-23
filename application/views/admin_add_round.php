


<div class="container">
<div class="row">
  <div class="page-header">
  <h1>Round list</h1>
  </div>
    <div class="col-xs-6 ">
      
      

      <?php
        echo "<ul id='roundList' class='list-group sortable'> ";
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
            echo "<li class='list-group-item' id='" . $seqRounds[$i]->roundId . "'>" . $seqRounds[$i]->roundName  . "<a class='pull-right'  href='" . base_url() . "admin/Round/" .  $seqRounds[$i]->roundId . " ' class='btn btn-lg' role='button' ><span class=' pull-right glyphicon glyphicon-arrow-right'></span></a>  <a class='pull-right'  href='" . base_url() . "admin/deleteRound/" .  $seqRounds[$i]->roundId . " ' class='btn btn-lg' role='button' onclick='return confirmation()'><span class=' pull-right glyphicon glyphicon-remove'></span></a>
                      <a class='pull-right' href='#round" . $seqRounds[$i]->roundId . "'class='btn btn-lg' role='button' data-reveal-id='myModal'><span class='glyphicon glyphicon-edit'></span></a> 
                  


            </li>";
        }
        for ($i=0;$i<count($noSeqRounds);$i++){
            echo "<li class='list-group-item' id='" . $noSeqRounds[$i]->roundId . "'>" . $noSeqRounds[$i]->roundName  . "</li>";
        }
        
        echo "</ul>";
        ?>



    </div>
</div>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/reveal.css">
<script src="<?php echo base_url();?>assets/js/jquery-1.4.4.min.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>assets/js/jquery.reveal.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/html.sortable.src.js"></script>
<script>
$(document).ready(function(){
    $('a').click(function(){
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

</script>
      <script>
        $(".sortable").sortable({
          connectWith: '.js-connected'
        }).bind('sortupdate', function(e, ui) {
          updateRoundSequence();
        });

        $( window ).unload(updateRoundSequence());


        function updateRoundSequence(){
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
        }
      </script>





    <div class="page-header">
      <h1>New Round</h1>
    </div>
            <?php $attributes = array("class" => "form-horizontal", "name" => "contactform");
            echo form_open(base_url() . "Admin/newRound", $attributes);?>

    <div class="col-lg-6">

                <div class="form-group" >
                    <label for="roundName">Round name</label>
                    <input type="text" class="form-control" id="roundName" placeholder="Enter name of Round" name="roundName" value='<?php echo set_value('roundName'); ?>'>
                    <span class="text-danger"><?php echo form_error('roundName'); ?></span>
                </div>
                

              

                


                <input class="btn btn-lg" type="submit" value="Add Round" name="addTeam">

            <?php echo form_close(); ?>
            <?php echo $this->session->flashdata('roundMsg'); ?>
    </div>  

                 
    <div class="target"></div>

    <?php

    foreach ($seqRounds as $seqRound) {

          echo "<div id='round". $seqRound->roundId ."'><div id='myModal' class='reveal-modal'>";
          echo "<form method='post' action='" . base_url() . "admin/updateRound'>";

          echo "<input type='hidden' name='roundId' value='" . $seqRound->roundId . "' />";
          echo "<div class='form-group' >
          <label for='questionValue'>Round name</label>
          <input type='text' class='form-control' id='questionValue' placeholder='Enter name of round' name='roundName' value='". $seqRound->roundName ." '>
          </div>";
          echo "<input type='submit' value='change round' name='change' />";
          echo "</form>";
          echo "<a class='close-reveal-modal'>&#215;</a></div></div>";  
        }



?>




        
    





	</div>