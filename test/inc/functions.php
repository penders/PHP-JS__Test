<?php
require_once __DIR__ . '/../vendor/autoload.php';
    $db = mysqli_connect('localhost', 'root', '', 'kviz');




$msg = new \Plasticbrain\FlashMessages\FlashMessages();


    // variable declaration
    $name = "";
    $email    = "";
    $errors = array(); 


       
    
    
    
    // REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // form validation: ensure that the form is correctly filled
    if (empty($name)) { $msg->error('Name is required');    
    }
    if (empty($email)) { $msg->error('Email is required'); 
    }
    if (empty($password_1)) { $msg->error('Password is required');
    }
    // Check if passworfds match
    if ($password_1 != $password_2) {
        $msg->error("The two passwords do not match");
    }
    // CHECK IF NAME OR EMAIL ALREADY EXISTS
    $sql_n = "SELECT * FROM users WHERE name='$name'";
    $sql_e = "SELECT * FROM users WHERE email='$email'";
    $res_n = mysqli_query($db, $sql_n);
    $res_e = mysqli_query($db, $sql_e);
        
    

    if (mysqli_num_rows($res_n) > 0) {
        $msg->error("Name exists");
    }else if(mysqli_num_rows($res_e) > 0) {
        $msg->error("Email exists");
    }else if($msg->hasErrors()) {
            
        array_push($errors, "Be more careful");
    
    } else {

        // register user if there are no errors in the form
        if (count($errors) == 0) {
            $password = password_hash($password_1, PASSWORD_DEFAULT);
            //encrypt the password before saving in the database
            $query = "INSERT INTO users (name, email, password) 
					  VALUES('$name', '$email', '$password')";
            mysqli_query($db, $query);
            setcookie("mans", $row["name"], time()+3600);
            $_SESSION['id'] = $u_id;
            $_SESSION['name'] = $name;
            $_SESSION['success'] = "You are now logged in";

            header('location: index.php');
        }
    }

}

    // ... 

    
    
    
    
    
    
    // LOGIN USER
if(isset($_POST["login_user"])) {  
    if(empty($_POST["name"]) || empty($_POST["password"])) {  
             $msg->error('Both Fields are required');
    }  
    else  
        {  
         $name = mysqli_real_escape_string($db, $_POST["name"]);  
         $password = mysqli_real_escape_string($db, $_POST["password"]);  
         $query = "SELECT * FROM users WHERE name = '$name'";  
         $result = mysqli_query($db, $query);  
        if(mysqli_num_rows($result) > 0) {  
            while($row = mysqli_fetch_array($result))  
            {  
                if(password_verify($password, $row["password"])) {  
                     //return true;  
                    setcookie("mans", $row["name"], time()+3600);

                     $_SESSION["name"] = $name;  
                     header("location:index.php"); 
                    $msg->success('You are logged in');
                    $_SESSION['success'] = "You are now logged in";
                    
                }  
                else  
                 {  
                     //return false;  
                    $msg->error('Wrong Password');
                }  
            }  
        }  
        else  
         {  
            $msg->error('Wrong user Name');
        }  
    }  
}  
    
    

    
    
    
    
    
    
    
    
          // CHANGE PASSWORD
if (isset($_POST['changePsw'])) {
    // receive all input values from the form
    $currPsw = mysqli_real_escape_string($db, $_POST['current_password']);
    $newPsw = mysqli_real_escape_string($db, $_POST['password']);
    $checkPsw = mysqli_real_escape_string($db, $_POST['confirm_password']);

    // form validation: ensure that the form is correctly filled
    if (empty($currPsw)) { $msg->error('Current Password is required'); return;    
    }
    if (empty($newPsw)) { $msg->error('New Password is required');  return;
    }
    if (empty($checkPsw)) { $msg->error('Please confirm new password'); return;
    }
    
    // Check if passwords match
    if ($newPsw != $checkPsw) {
        $msg->error("The two passwords do not match"); return;
    }
    
    
    $username = $_SESSION['name'];

    $query = "SELECT * FROM users WHERE name = '$username'";  
         $result = mysqli_query($db, $query);  
    if(mysqli_num_rows($result) > 0) {  
        while($row = mysqli_fetch_array($result))  
        {  
            if(password_verify($currPsw, $row["password"])) {  
                 //return true;  
                $password = password_hash($newPsw, PASSWORD_DEFAULT);
                //encrypt the password before saving in the database
                $username = $_SESSION['name'];
                $query1 = "UPDATE users SET password = '$password' WHERE name = '$username' ";
                mysqli_query($db, $query1);
                $msg->success('Password has been successfully changed');

            }  
            else  
             {  
                 //return false;  
                $msg->error('Wrong Password');
            }  
        }  
       
    } 
  

  
  
  
  
}


    // ... 
    
    
    
    
    
    // LOGOUT
    
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['name']);
    setcookie("mans", "", time()-3600);

    header("location: login.php");
}
    
    
    
    
    
    
        // GET USER INFO
    
function getU($n)
{
    try {
        $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch ( \Exception $e ) {
        echo 'Error connecting to the Database: ' . $e->getMessage();
        exit;
    }
    
    $sql = "SELECT * FROM users WHERE users.name = ?
		  

		  ";
    
    try {
        $results = $db->prepare($sql);
        $results->bindValue(1, $n, PDO::PARAM_INT);
        $results->execute();
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
    return $results->fetchAll();
}








            // CHECK IF USER HAS ALREADY COPLETED THIS TEST

    
function getSC($u_id, $id) 
{ 
    try {
        $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch ( \Exception $e ) {
        echo 'Error connecting to the Database: ' . $e->getMessage();
        exit;
    }
    
    $sql = "SELECT * FROM scores WHERE scores.user_id = ? AND scores.T_id = ?
		  

		  ";
    
    try {
        $results = $db->prepare($sql);
        $results->bindValue(1, $u_id, PDO::PARAM_INT);
        $results->bindValue(2, $id, PDO::PARAM_INT);
        $results->execute();
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
    return $results->fetchAll();
}





    
    
    
    
        // GET TEST INFO
    
function getT($id)
{
    try {
        $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch ( \Exception $e ) {
        echo 'Error connecting to the Database: ' . $e->getMessage();
        exit;
    }
    
    $sql = "SELECT * FROM tests WHERE tests.T_id = ?
		  

		  ";
    
    try {
        $results = $db->prepare($sql);
        $results->bindValue(1, $id, PDO::PARAM_INT);
        $results->execute();
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
    return $results->fetchAll();
}
    
    
    
    // Tests list
    
function get_test_list() 
{ 
    $db = mysqli_connect('localhost', 'root', '', 'kviz');
    
    try {
        return $db->query('SELECT T_id, testname FROM tests');
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return array();
    }
}



// SELECT QUESTIONS WORKING


function getQ($id)
{
    try {
        $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch ( \Exception $e ) {
        echo 'Error connecting to the Database: ' . $e->getMessage();
        exit;
    }
    
    $sql = "SELECT * FROM questiontable WHERE questiontable.test_id = ?
		  

		  ";
    
    try {
        $results = $db->prepare($sql);
        $results->bindValue(1, $id, PDO::PARAM_INT);
        $results->execute();
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
    return $results->fetchAll();
}






//    SELECT ANSWERS




function getA($id)
{
    try {
        $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch ( \Exception $e ) {
        echo 'Error connecting to the Database: ' . $e->getMessage();
        exit;
    }
        
    $number = $_GET["Q"];

    $sql = "SELECT * FROM answertable WHERE answertable.t_id = ? AND answertable.q_id = $number
		  

		  
		  ";
    
    
    try {
        $results = $db->prepare($sql);
        $results->bindValue(1, $id, PDO::PARAM_INT);
        $results->execute();
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
    return $results->fetchAll();
}





//    SELECT ANSWERS FOR JAVASCRIPT




function getAjs($id)
{
    try {
        $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch ( \Exception $e ) {
        echo 'Error connecting to the Database: ' . $e->getMessage();
        exit;
    }
        

    $sql = "SELECT * FROM answertable WHERE answertable.t_id = ?
		  

		  
		  ";
    
    
    try {
        $results = $db->prepare($sql);
        $results->bindValue(1, $id, PDO::PARAM_INT);
        $results->execute();
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
    return $results->fetchAll();
}













    //  AFTER TEST SUBMIT 
    
    
    //Check to see if score is set
if(!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}
    
if(isset($_POST['test'])) {
                unset($_SESSION['noAns']);
                $number = $_POST['number'];

                //  CHECK IF ANSWER IS SELECTED
    if($_POST['ans']=="no_attempt") {
        $_SESSION['noAns'] = "Jāizvēlas 1 atbilžu variants";
        header("Location: test.php?Q=".$number);
        exit();
    }
            
    // GET POSTS
    $totQ = $_POST['totQ'];
    $id = $_POST['id'];
    $u_id = $_POST['u_id'];

    $selected_choice = $_POST['ans'];
    $next = $number+1;
    $_SESSION['number']= $number+1;
        
    /*
    *    Get correct choice
    */
        
    $query = "SELECT * FROM answertable
					WHERE q_id = $number AND t_id = $id AND correct = 1";
                    
    //Get result
    $result = mysqli_query($db, $query);
        
    //Get row
    $row = $result->fetch_assoc();
        
    //Set correct choice
    $correct_choice = $row['A_id'];
        
    //Compare
    if($correct_choice == $selected_choice) {
        //Answer is correct
        $_SESSION['score']++;
        $i++;    
    }
        
        

    //Check if last question
    if($number == $totQ) {
            
        $id = $_SESSION['T_id'];
        $u_id = $_SESSION['u_id'];
        $score = $_SESSION['score'];
        $SC = getSC($u_id, $id);
            
        //  IF TEST IS ALREADY IN DB THEN UPDATE TEST
        if (count($SC) > 0) {
            $query1 = "UPDATE scores SET score = '$score' WHERE user_id = $u_id AND T_id = $id  ";
            mysqli_query($db, $query1);

        } else {
            //  IF TEST COMPLETED FOR THE FIRST TIME
            $querys = "INSERT INTO scores (user_id, T_id, score) 
					  VALUES('$u_id', '$id', '$score') ";
            mysqli_query($db, $querys);
            
        }
            
        header("Location: done.php");
        exit();
    } else {
        header("Location: test.php?Q=".$next);
    }
}









    //  AFTER JS_TEST SUBMIT 



if(isset($_POST['JS_test'])) {
               
            
    // GET POSTS
    $score = $_POST['score'];
    $id = $_POST['id'];
    $u_id = $_POST['u_id'];
    $SC = getSC($u_id, $id);


        //  IF TEST IS ALREADY IN DB THEN UPDATE TEST
    if (count($SC) > 0) {
        $query1 = "UPDATE scores SET score = '$score' WHERE user_id = $u_id AND T_id = $id  ";
        mysqli_query($db, $query1);

    } else {
        //  IF TEST COMPLETED FOR THE FIRST TIME
        $querys = "INSERT INTO scores (user_id, T_id, score) 
					  VALUES('$u_id', '$id', '$score') ";
        mysqli_query($db, $querys);
            
    }
            
    header("Location: done.php");
        exit();
}

    
    
    





