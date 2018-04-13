<?php 

require '/inc/connection.php';
require '/inc/functions.php';
require '/inc/head.php';
require '/inc/nav.php';


/* if (isset($_SESSION['name'])) {
        header('location: index.php');
    } */


    //Set question number
if (isset($_GET["Q"])) {
    //$number = filter_input(INPUT_GET,"Q",FILTER_SANITIZE_NUMBER_INT);
    $number = (int) $_GET['Q'];  
    
}

      // DON`T ALLOW JUMPING QUESTIONS IN ADDRESS BAR
if ($_SESSION['number'] != $number) {
    header("location: test.php?Q=".$_SESSION['number']);
} 

  
  
  // GET TEST ID, QUESTIONS AND ANSWERS
    
    $id = $_SESSION['T_id'];
    $item = getQ($id);
    $row = getA($id);
    
    
    // TOTAL QUESTION COUNT
    $totQ = count($item);
    
    
    
    // ARRAY NUMBER FOR QUESTIONS
    $j = $number-1;
    
    $u_id = $_SESSION['u_id'];
    
    
?>


<?php //    LAYOUT FOR THE TEST ?>

    <div class="kaf">
        <div id="inkaf">
        
        
    <?php //    INSERT COFFEE PICTURE ?>
                <img src="src/logo.png">
           
         
         
    <?php 
    // CHECK IF ANSWER IS NOT EMPTY. IF IT IS THEN SHOW MSG
    if(isset($_SESSION['noAns'])) { ?>
    <div class="error">
            
    <?php
    $msg->error($_SESSION['noAns']);
    $msg->display(); 
    }       ?>
    </div>
    

    
    
    
    

    
    <!--      SHOW QUESTION    -->
<form method="post" action="test.php">

             
                <h2><?php  echo $item[$j]['questions'];?>  </h2>
                        <p>  Šis ir <?php echo $number; ?>. no <?php echo $totQ; ?>  jautājumiem</p>
                
            
                
                
           <section> 
    <?php	
    
    
    
    // SHOW ANSWERS

    $i=1;
    foreach ($row as $rows) {?>
                                  

    <?php if(isset($rows['ans'])) {?>
    
    
    
    
<div id="divAns">
 <input  id="<?php echo $rows['A_id']; ?>" name="ans" type="radio" value="<?php echo $rows['A_id']; ?>" /> 
 <label for="<?php echo $rows['A_id']; ?>">
    <?php echo  $i; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rows['ans']; ?> 
</div>

    





    <?php }    // HIDDEN BUTTON IF NO ANSWER SELECTED ?>
        
                <td><input type="radio" checked="checked" style="display:none" value="no_attempt" name="ans" /></td>
    <?php $i++;        
    }
    ?>
 
            
    

    <?php 
                //  NEXT OR SUBMIT BUTTON
    if ($number == $totQ) { ?>
          <center><input type="submit" value="Pabeigt testu" name="test" class="nextBtn" /></center>

        <?php
    } else {  ?>
   <center><input type="submit" value="Nākamais jautājums" name="test" class="nextBtn" /></center>

    <?php
    } ?>
        <!--   ALL OTHER VALUES   -->
    <input type="hidden" name="number" value="<?php echo $number; ?>" />
        <input type="hidden" name="totQ" value="<?php echo $totQ; ?>" />
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input type="hidden" name="u_id" value="<?php echo $u_id; ?>" />

        
</section>
</form>    

<?php
/* if(isset($_POST['noAns'])){
        $msg->error( "Name exists");
        $msg->display(); 
    }
     */
     
     
      // redirect too-large question numbers to tests
if ($number > $totQ) {
    header("location:tests.php");
}
  // redirect too-small question numbers to the first question
if ($number < 1) {
    header("location:test.php?Q=1");
} 
  
  
  
  
// END OF KAF AND INKAF DIVS
    ?>
            </div>
    </div>
    
    
    
    
    
