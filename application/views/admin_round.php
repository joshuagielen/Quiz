 <div class="container text-center">


    



   <div class="page-header">

    <?php echo "<h1>" . $roundRow->roundName  . "</h1>";?>
    
 
</div>

<div class="row">
    <div class="col-xs-6">
      <?php
        echo "<ul class='list-group text-left'> ";
        foreach ($questions as $question) {
              echo "<li class='list-group-item'>" . $question->questionId . ".\t" . $question->questionValue  . "</li>";
        }
        echo "</ul>";
        ?>



    </div>


    <div class="col-xs-6">
      <?php
        echo "<ul class='list-group text-left'> ";
        foreach ($questionqueues as $questionqueue) {
              echo "<li class='list-group-item'>" . $questionqueue->sequenceNumber . ".\t" . $questionqueue->question  . "</li>";
        }
        echo "</ul>";
        ?>
      </div>
</div>
                


                
                    
               
                

                 





        
    





  </div>
