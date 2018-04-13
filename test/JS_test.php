<?php 

require '/inc/connection.php';
require '/inc/functions.php';
require '/inc/head.php';
require '/inc/nav.php';

  //Set question number
if (isset($_GET["Q"])) {
    //$number = filter_input(INPUT_GET,"Q",FILTER_SANITIZE_NUMBER_INT);
    $number = (int) $_GET['Q'];  
    
}

      // DON`T ALLOW JUMPING QUESTIONS IN ADDRESS BAR
if ($_SESSION['number'] != $number) {
    header("location: test.php?Q=".$_SESSION['number']);
} 
  
// GET USER ID, TEST ID
    $u_id = $_SESSION['u_id'];
  
    $id = $_SESSION['T_id'];
    
    // GET QUESTIONS AND CONVERT TO JSON
    
    $item = getQ($id);
    $items_json = json_encode($item);
    
    // GET ANSWERS AND CONVERT TO JSON
    
    $row = getAjs($id);
    $rows_json = json_encode($row);
    
    // CHECK SCORE 
    $score = getSC($u_id, $id);

foreach ($score as $scores) {
                  $scores['score'];
                $SC = $scores['score'];
}
if(count($score) == 0) {
    $SC = 0;
}
    ?> 
   
    <div class="kaf" id="kaff">
        <div id="inkaf">

        
   <img src="src/logo.png" alt="Coffee">
     </div>
   <h2>Question...</h2>
   <p color="red">This is where current question and total questions will be</p>
   <p><p>   
   
   
       <section> 
    <div id="divMain">
    <div id="divAns">
    
    </div>
    </div>
    <center><button class="nextBtn"  id="but" >Nākamais jautājums</button></center>
    

    
    
       
    </section> 
    
    
   
 
   </div>   
   
   
   
   
   
   
   
   
   
   
 <script>
 
 const kaf = document.getElementsByClassName('kaf');
 const h2 = document.getElementsByTagName('h2');
 const h3 = document.getElementsByTagName('h3');
 const p = document.getElementsByTagName('p');
 const but = document.getElementById('but');
  const kaff = document.getElementById('kaff');
   const postBut = document.getElementsByClassName('nextBtn');


 
 const Q = JSON.parse('<?php echo $items_json; ?>');
 const A = JSON.parse('<?php echo $rows_json; ?>');
 
 
 // QUESTION NUMBER, TOTAL QUESTIONS, SCORE
 let Qnr = 0;
 const totQ = Q.length;
 let score = 0;
 document.body.onload = load(Qnr);

 function load (Qnr) {
     // ERROR MSG IF NO ANSWER. BACK TO NOTHING
     p[1].textContent = '';
     // GET QUESTIONS
     h2[0].textContent = Q[Qnr].questions;
     // GET STATUS
     p[0].textContent = 'Šis ir ' + (Qnr+1) + '. ' + 'no ' + totQ + '. jautājumiem.';
     
     // GET ANSWERS
     for (i = 0; i < A.length; i++) {
             if  (A[i].q_id == (Qnr+1)) {
            
  answer = document.createElement('input');
  answer.id = A[i].A_id;
  answer.name = 'ans';
  answer.type = 'radio';  
  answer.value = A[i].A_id;
  answer.min = A[i].correct;  
  
  answer2 = document.createElement('label');
  answer2.htmlFor = A[i].A_id;
  answer2.textContent = A[i].ans;
  
  //NO NEED FOR HIDDEN BUTTONS AS IN PHP
  
  // hidden = document.createElement('input');
  // hidden.type = 'radio';  
  // hidden.checked = 'checked'; 
  // hidden.style = 'display:none'; 
  // hidden.value = 'no_attempt'; 
  // hidden.name = 'ans';
  
  
  document.getElementById('divAns').appendChild(answer);
  document.getElementById('divAns').appendChild(answer2);
  // document.getElementById('divAns').appendChild(hidden);
  
  
  

   }
   
}    
// BACKGROUND HEGHT BASED ON ANSWER COUNT OR NEXT QUESTION BUTTON POSITION
var bodyRect = document.body.getBoundingClientRect(),
    elemRect = but.getBoundingClientRect(),
    offset   = elemRect.top - bodyRect.top;    
     kaff.style.height =  offset - 100 + 'px';
 };
 
 
 
 
 
 
    
     function loadNext (e) {
         // GET SELECTED ANSWER
        var selectedOption = document.querySelector('input[type=radio]:checked');
        
        // IF THERE`S NO ANSWER
        if(!selectedOption){
        p[1].style.color = 'red';
        p[1].textContent = 'Nav izvēlēts neviens atbilžu variants!';
        return;
    }
        // UPDATE SCORE IF ANSWER CORRECT
        let correctA = selectedOption.min;
        if(correctA == 1){
        score += 1;
    }
    
    // UNSELECT ANSWER
    selectedOption.checked = false;
    // NEXT QUESTION 
    Qnr++;
    
    
    // REMOVE ANSWERS
    var rem = document.getElementById('divAns');
    rem.parentNode.removeChild(rem);
    
    // CREATE DIV FOR NEW ANSWERS
    var divAns = document.createElement('div');
    divAns.id = 'divAns';
    document.getElementById('divMain').appendChild(divAns);
    
    
    // CHANGE BUTTON IN LAST QUESTION
    if(Qnr == totQ - 1){

        but.textContent = 'Pabeigt testu';

    }
    
    
    // IF TEST COMPLETED....
    
    if(Qnr == totQ){
        
        // NO BACKGROUND
                kaff.style.display = 'none';
        
        
        // CREATE FORM 
            var form = document.createElement('form');
    form.method = 'post';
    form.action = 'JS_test.php';
    form.id = 'forma';
    document.getElementById('kaff').appendChild(form);
    
        var center = document.createElement('center');
    center.id = 'center';
    document.getElementById('forma').appendChild(center);    
    
    
    // CREATE POST BUTTON
    var postB = document.createElement('input');
    postB.id = 'poga';
    postB.type = 'submit';
    postB.value = 'Pabeigt testu';
    postB.name = 'JS_test';
    postB.className = 'nextBtn';
    document.getElementById('center').appendChild(postB);    
    
    
    
    // POST SCORE, TEST ID, USER ID
     const postScore = document.createElement('input');
     postScore.id = 'score';
     postScore.type = 'hidden';
     postScore.name = 'score';
     postScore.value = score;
     document.getElementById('forma').appendChild(postScore);    
     
     const postT_id = document.createElement('input');
     postT_id.type = 'hidden';
     postT_id.name = 'id';
     postT_id.value = '<?php echo $id; ?>'
     document.getElementById('forma').appendChild(postT_id);

     const postU_id = document.createElement('input');
     postU_id.type = 'hidden';
     postU_id.name = 'u_id';
     postU_id.value = '<?php echo $u_id; ?>'
     document.getElementById('forma').appendChild(postU_id);

     // SUBMIT FORM
        document.getElementById("poga").click();
        
    }
        
    load(Qnr);
          
 };
    

    but.addEventListener('click', loadNext);



 


  </script>
  

                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    