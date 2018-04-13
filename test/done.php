<?php 

require '/inc/connection.php';
require '/inc/functions.php';
require '/inc/head.php';
require '/inc/nav.php';

/* if (isset($_SESSION['name'])) {
        header('location: index.php');
    } */
    
    
        // CHECK SCORE 

    $id = $_SESSION['T_id'];
    $u_id = $_SESSION['u_id'];
    $score = getSC($u_id, $id);

foreach ($score as $scores) {
                  $scores['score'];
                $SC = $scores['score'];
}

    ?>


    <h2><?php 
    $msg->success('THANK YOU!');
    $msg->success('You have completed this test. Your score was: '. $SC);
                    $msg->display();


    //    GET ALL THE SESSION INFO, TEST RESULTS
    ?>
    </h2>
    <table class="table table-striped">  
                         
                <tr><td><center><font size="6" color="red">Testa id <?php echo $_SESSION['T_id']; ?>  </font></center></td></tr>
                <tr><td><center><font size="6" color="red">Testa nosaukums - <?php echo $_SESSION['testname']; ?>  </font></center></td></tr>  
                <tr><td><center><font size="6" color="red">Username - <?php echo $_SESSION['name']; ?>  </font></center></td></tr>
                     </table>  

