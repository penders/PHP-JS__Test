<?php 

require '/inc/connection.php';
require '/inc/functions.php';
require '/inc/head.php';
require '/inc/nav.php';

if (!isset($_SESSION['name'])) {
    header('location: login.php');
}
    ?>
    
    <form method="post" action="account.php">

    <?php require 'errors.php';
    $msg->display();  
    ?>
        
          <div class="form">
    <form class="changePsw-form">
    <h1>Change password</h1>

      <input type="password" name="current_password" placeholder="Current password"/>
      <input type="password" name="password" placeholder="New password"/>
      <input type="password" name="confirm_password" placeholder="Confirm new password"/>

                    <button type="submit" class="btn" name="changePsw">Login</button>
    </form>
  </div>
  
