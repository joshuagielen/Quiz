<div class="container text-center">


    



  <div class="page-header">

    <?php echo "<h1 id='hed'>" . $roundRow->roundName  . "</h1>";?>
    
 
  </div>




<div class="row">
    <div class="col-xs-6">
      <?php
        echo "<ul class='list-group text-left sortable'> ";

        $questionsInQueue = array();
        foreach ($questionqueues as $questionqueue){
          array_push($questionsInQueue, $questionqueue->questionId);

        }

        foreach ($questions as $question) {
            if (in_array($question->questionId, $questionsInQueue)){
            }
            else {
              echo "<li class='list-group-item' id='" . $question->questionId . "'>" . $question->questionValue  . "</li>";
            }
        }
        echo "</ul>";
        ?>



    </div>



    <div class="col-xs-6">
      <?php
        echo "<ul id='roundqs' class='list-group text-left sortable'> ";
        foreach ($questionqueues as $questionqueue) {
              echo "<li class='list-group-item' id='" . $questionqueue->questionId . "'>" . $questionqueue->question  . "</li>";
        }
        echo "</ul>";
        ?>
      </div>
      
  </div>
</div>
<div id="test"></div>
<script src="http://<?php echo base_url();?>assets/js/html.sortable.src.js"></script>
      <script>
        $(".sortable").sortable({
          connectWith: '.js-connected'
        }).bind('sortupdate', function(e, ui) {
          var roundSize = document.getElementById("roundqs").getElementsByTagName("li").length;
          var data = new Array();
          for (i = 0; i < roundSize; i++) {
            data[i] = $('#roundqs li')[i].id;
          }
          
          var p = {};
          p['rId'] = <?php echo $roundRow->roundId; ?>;
          p['questions'] = data;




          $.ajax({
            type:'POST',
            url:'http://<?php echo base_url() ?>QuestionQueue/Update',
            data:p,
            success:function(data){
                $('#hed').html(data);
                $('#hed').html('post success');
                alert(data);
            },
            error: function(a, b, c) {
              alert(a + ' ' + b + ' ' + c);
            }
        });
        });
      </script>