<?php 

require '/inc/connection.php';
require '/inc/functions.php';
require '/inc/head.php';
require '/inc/nav.php';

if (isset($_SESSION['name'])) {
    header('location: index.php');
}
    ?>
    
    <form method="post" action="login.php">

    <?php require 'errors.php';
    $msg->display();  
    ?>
    
    
          <div class="form">
    <form class="login-form">
    <h1>Log in</h1>

      <input type="text" name="name" placeholder="Name"/>
      <input type="password" name="password" placeholder="Password"/>
                    <button type="submit" class="btn" name="login_user">Login</button>
    </form>
  </div>
  
