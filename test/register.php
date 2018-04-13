<?php 

require '/inc/connection.php';
require '/inc/functions.php';
require '/inc/head.php';
require '/inc/nav.php';

if (isset($_SESSION['name'])) {
    header('location: index.php');
}

    ?>

<body>

    
    <form method="post" action="register.php">

    <?php 
    $msg->display(); 
    ?>
    
              <div class="form">
    <form class="register-form">
        <h1>Register</h1>
     <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Name"/>
     <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Email"/>
     <input type="password" name="password_1" placeholder="Password"/>
     <input type="password" name="password_2" placeholder="Confirm password"/>

            <button type="submit" class="btn" name="reg_user">Register</button>
    </form>
  </div>

</body>
