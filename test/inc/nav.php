                <?php // PICTURE ABOVE NAV ?>

 <header>
    <h1>A story about getting lost.</h1>
  </header>

  <nav id="main">
    <ul>
      <li class="logo"><a href="#">LOST.</a></li>
                <li><a href="/test/">Home</a></li>
                <li><a href="/test/tests.php">Tests</a></li>  
                <li><a href="/test/JS_tests.php">JS_Tests</a></li>  
                
    <?php //if logged in then setcookie
    if (isset($_SESSION['name'])) {              
        setcookie("mans", $_SESSION['name'], time()+3600);
    }?>
            
    <?php  // NAVIGATION BAR IF LOGGED IN
    if (!isset($_SESSION['name'])) : ?>
                <li><a href="/test/login.php">Login</a></li>
                <li><a href="/test/register.php">Register</a></li>
                <?php else: ?>
                <li><a href="/test/account.php">My Account</a>
                <li><a>Welcome, <?php echo $_SESSION['name']; ?></a></li>
                <li><a href="index.php?logout='1'">Logout</a></li>
                <?php endif; ?>
    </ul>
  </nav>
        <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>

<script src="js/js.js"></script>














