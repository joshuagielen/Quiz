
<div class="container-fluid text-center">
  <!-- CSS & JQuery for popup login and register pane -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/reveal.css">
  <script src="<?php echo base_url();?>assets/js/jquery-1.4.4.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/js/jquery.reveal.js" type="text/javascript"></script>
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

function submitenter(myfield,e)
{
  var keycode;
  if (window.event) keycode = window.event.keyCode;
  else if (e) keycode = e.which;
  else return true;

  if (keycode == 13 && validate()) {





   myfield.form.submit();
   return false;
  }
 else
   return true;
}

function validate()
{
 
   if( document.addQuestion.questionValue.value == "" )
   {
     alert( "Please provide your question!" );
     document.addQuestion.questionValue.focus() ;
     return false;
   }
   if( document.addQuestion.questionType.value == "" )
   {
     alert( "Please provide your type of question!" );
     document.myForm.questionType.focus() ;
     return false;
   }

    if( document.addQuestion.questionGenre.value == "" )
   {
     alert( "Please provide your genre of question!" );
     document.myForm.questionGenre.focus() ;
     return false;
   }
   
   return true;
}
</script>
<script>
        var answer = 1;
        var count = 0;
        function add_fields() {
            answer++;
            count++;
            var objTo = document.getElementById('answers')
            var divtest = document.createElement("div");
            divtest.innerHTML = '<div class="form-group"><div class="form-inline "><label for="answer">Answer ' + answer + ' </label><input class="form-control" id="answer" name="answers[' + count + '][value]" type="text" placeholder="Enter answer value" required autofocus><label for="answer1">Score of answer </label><input class="form-control" id="answers" type="text" name="answers[' + count + '][score]" placeholder="Enter score of answer" required></div></div>';
            
            objTo.appendChild(divtest)
            window.scrollTo(0,document.body.scrollHeight);
        }


        function findmyvalue()
        {
            var selectIndex = document.getElementById("types").selectedIndex;
            alert(selectIndex);

            
            replaceContentInContainer(selectIndex);
        }


        function replaceContentInContainer(selectIndex) {

          if(selectIndex <1){
            answer = 0;
              document.getElementById("answerType").innerHTML = '<div class="form-group"><div class="form-inline "><label for="answer">Answer</label>' + 
                    '<input class="form-control" id="answer" name="answers[0][value]" type="text" placeholder="Enter answer value" required autofocus>' +
                    '<label for="answer1">Score of answer </label><input class="form-control" id="answer" type="text" name="answers[0][score]" placeholder="Enter score of answer" required></div></div>';

          }else{
            document.getElementById("answerType").innerHTML = '<div id="answers"><div class="form-group"><div class="form-inline ">' +
                            '<label for="answer">Answer 1</label><input class="form-control" id="answer" name="answers[0][value]" type="text" placeholder="Enter answer value" required autofocus>' +
                            '<label for="answer1">Score of answer</label><input class="form-control" id="answer" type="text" name="answers[0][score]" placeholder="Enter score of answer" required>' +
                            '</div></div></div><a href="#"  onclick="add_fields();"  class="btn btn-lg" role="button"><span class="glyphicon glyphicon-plus-sign"></span></a></br>';

          
          }

          
            
            

        }
</script>



<div class="page-header">
  <h1>Questions</h1>
</div>





<table class="table table-bordered">
  <thead>
    <tr><th class="text-center">ID</th><th class="text-center">Vraag</th><th class="text-center">Genre</th><th class="text-center">Type</th><th class="text-center">Action</th></tr></thead>
    <tbody>
      <?php
      foreach ($questions as $question) {
        echo "<tr><td>" . $question->questionId . "</td><td>" . $question->questionValue  . "</td><td>" . $question->questionGenre . "</td><td>" . $question->questionType .
        "</td><td>
        <a href='#question" . $question->questionId . "'class='btn btn-lg' role='button' data-reveal-id='myModal'><span class='glyphicon glyphicon-edit'></span></a> 

        <a href='" . base_url() . "admin/deleteQuestion/" .  $question->questionId . " ' class='btn btn-lg' role='button' onclick='return confirmation()'><span class='glyphicon glyphicon-remove'></span></a></td></tr>";  
      }

      ?>
    



   </tbody>

 </table>



 <div class="target"></div>


 <?php

 foreach ($questions as $question) {

  echo "<div id='question". $question->questionId ."'><div id='myModal' class='reveal-modal'>";
  echo "<form method='post' action='" . base_url() . "admin/updateQuestion'>";

  echo "<input type='hidden' name='questionId' value='" . $question->questionId . "' />";
  echo "<div class='form-group' >
  <label for='questionValue'>Vraag</label>
  <input type='text' class='form-control' id='questionValue' placeholder='Enter question' name='questionValue' value='". $question->questionValue ." '>
  </div>";
  echo "<div class='form-group' >
  <label for='questionGenre'>Genre</label>
  <input type='text' class='form-control' id='questionGenre' placeholder='Enter genre of question' name='questionGenre' value='". $question->questionGenre ." '>
  </div>";
  echo "<div class='form-group' >
  <label for='questionType'>Type</label>
  <input type='text' class='form-control' id='questionType' placeholder='Enter type of question' name='questionType' value='". $question->questionType ." '>
  </div>";
  echo "<input type='submit' value='change question' name='change' />";
  echo "</form>";
  echo "<a class='close-reveal-modal'>&#215;</a></div></div>";  
}



?>

<h2 class="text-left">Add question</h2>
  <form method='post' action='<?php echo base_url() ?>admin/addQuestion'>
    <div class="col-lg-8">
              <div class="form-group">
                    <label for="questionValue">Question</label>
                    <input class="form-control" id="questionValue" name="questionValue" type="text" placeholder="Enter name of question" required autofocus>
              </div>
              <div class="form-group">
                  <label for="questionGenre">Genre</label>
                  <select class="form-control" name="questionGenre">
                      <?php
                        foreach($genres as $genre){
                            echo "<option value='" . $genre->genreId . "'>" . $genre->genreName . "</option>";
                          }
                      ?>
                  </select>
              </div>
               <div class="form-group">
                  <label for="questionType">Type</label>
                  <select class="form-control" onchange="findmyvalue()"  id="types" name="questionType">
                      <?php
                        foreach($types as $type){
                            echo "<option value='" . $type->typeId . "'>" . $type->typeName . "</option>";
                          }
                      ?>
                  </select>
              </div>

              <div id="answerType">

              <div class="form-group">
                    <div class="form-inline "><label for="answer">Answer</label>
                        <input class="form-control" id="answers" name="answers[0][value]" type="text" placeholder="Enter answer value" required >
                        <label for="answer1">Score of answer </label><input class="form-control" id="answers" type="text" name="answers[0][score]" placeholder="Enter score of answer" required>
                    </div>
              </div>


              
               </div>
              <input class="btn btn-lg" type="submit" value="Add Question" name="addQuestion">
   
    
             
    </div>
  </form>



 



</div>




