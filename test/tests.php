<?php 

require '/inc/connection.php';
require '/inc/functions.php';
require '/inc/head.php';
require '/inc/nav.php';

/* if (isset($_SESSION['name'])) {
        header('location: index.php');
    } */

    ?>

<?php	// GET USER INFO IF LOGGED IN

if (isset($_SESSION['name'])) {
    $n = $_SESSION['name'];
    
    $getU = getU($n);        
    ?>
    
          
        <h2><?php	   foreach ($getU as $user) {
            $user['id'];
            $_SESSION['u_id'] = $user['id'];
            $user['name'];
       }
} ?></h2>
    
    <?php	
    // UNSET TEST, score  IF TEST NOT SELECTED
    if (!isset($_GET["id"])) {
        unset($_SESSION['T_id']);
        unset($_SESSION['testname']);
        unset($_SESSION['score']);
		unset($_SESSION['number']);
        unset($_SESSION['noAns']);
		
    }   



	// AFTER TEST SELECTED, AFTER TEST SELECTED, AFTER TEST SELECTED, AFTER TEST SELECTED
	
	
	
	
	
	
	
    // GET TEST INFO
    if (isset($_GET["id"])) {
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        
        //REMEMBER SELECTED TEST ID
        if(!isset($_SESSION['T_id'])) {
            $_SESSION['T_id'] = $id;
        }
        // SET USER ID
        if (isset($_SESSION['name'])) {
            $u_id = $_SESSION['u_id'];
        } 
        
        
        
        $getT = getT($id);
		
		
		
		
		//  CREATE SESSION NUMBER
		
		
		$_SESSION['number'] = 1;
		
		
		
		
		
		
		
		//GET QUESTION INFO FOR TOTAL QUESTIONS 
		
        $item = getQ($id); 
		$totQ = count($item);		



		
		// GET TOTAL TEST COUNT AND REDIRECT IF FALSE ID

foreach (get_test_list() as $item) {
					$totT = count($item);		
        }
		
	  // redirect too-large test number
	if ($id > $totT) {
    header("location:tests.php");
  }
  // redirect too-small test number
  if ($id < 1) {
    header("location:tests.php");
  } 
		
		
		
		



		
        
        ?>

     
     
     <div class="header">
     <h2><?php	 
        // GET SELECTED TEST NAME 
        foreach ($getT as $testName) {
            echo $testName['testname']; 
        }?></h2>
    </div>
        <?php
        $_SESSION['testname'] = $testName['testname'];
    ?>
	
	
	
    

    
     <h3><?php	  //         // CHECK IF USER HAS ALREADY COPLETED THIS TEST
        if (isset($_SESSION['name'])) {
                    
            $score = getSC($u_id, $id);

            foreach ($score as $scores) {
                        $msg->success('You have already completed this test. Your score was: '. $scores['score']);
                $msg->display();
            }
        } ?></h3>
    
    

    
    <center><font size="6" color="red">Kopā būs <?php echo $totQ; ?>  jautājumi</font></center>
    </div>
    <br><br><br>
    
    <?php  
      // CHECK IF LOGGED IN AND BUTTON IF TEST IS SELECTED
    if (isset($_SESSION['name'])) : ?>
         <center><a href="test.php?Q=1" class="btn btn-success" class="start">Sākt testu</a></center>
                    <?php else:
                $msg->info('You have to be logged in to start the test');
                    $msg->display();
                    endif; ?>
        <br/> <br/> <br/> <br/> <br/> <br/>
         


    
    
    
    
    
    
    <?php
    }else {
        ?>
     <div class="header" id = "bounceInUp">
     <h2>List of Tests</h2>
    </div>
       
		
		
		
		
		
		     <div id="bounceInRight">

		
		 <?php
		
        // TEST LIST IF TEST NOT SELECTED
		
		
		
		
		
		
        foreach (get_test_list() as $item) {
            echo "<li><h2><a href='tests.php?id=" . $item['T_id'] . "'>" . $item['testname'] . "</a></h2>";
            echo "</li>";
			
			
        }

		
			
    }
                
				?>
    </div>
	  <script>
			$('#bounceInUp').addClass('animated bounceInUp');

			$('#bounceInRight').addClass('animated bounceInRight');
			

            
			  </script>
  
			
