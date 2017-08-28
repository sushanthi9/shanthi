<?php

//print_r($errors);
//echo <br> $message;

            //start a session
            //SESSION is an array of variables
            session_start();
  
      //get database connection
    include("includes/database.php");
 

if($_SERVER["REQUEST_METHOD"]=="POST"){
    
 //   unset($message);
//    unset($errors);
    
    $user_email=$_POST["user"];
    //check if the user entered an email address
    
    //php built in feature to check if it is valid email
    if(filter_var($user_email,FILTER_VALIDATE_EMAIL)){
        
        //if true,user entered an email
         $query="SELECT * FROM accounts WHERE email=?";
    }
    else{
        
        //if false,user entered a username
        // $query="SELECT * FROM accounts WHERE name='$user_email'";
        $query="SELECT * FROM accounts WHERE name=?";
    }
    $pass=$_POST["password"];
    
//echo $password;
  
 
    
    //construct query with email variable
    //$query="SELECT * FROM accounts WHERE email='$email'";
    
     //crete array of store errors
    $errors=array();
    
    //run query
          $statement = $connection->prepare($query);
          //s string i integer b blob d double
          $statement->bind_param("s",$user_email);
          $statement->execute();
          //get the result of the query
          $userdata = $statement ->get_result();
   // $userdata = $connection->query($query);
    
    
    
    //check the results
    if($userdata->num_rows > 0){
        //converts result into associative array
        $user = $userdata->fetch_assoc();
        //print_r($user);
        //built in php function
        //php.net.com/manual
        //echo $user["password"];
        //echo password_verify[]$password,$user["password"]
        if(password_verify($pass,$user["password"])==false){
            $errors["account"]="email or password incorrect";
        }
        else{
            $message="You have been logged in";
            //create account id as a session variable
            $account_id = $user["id"];
            $_SESSION["id"] = $account_id;
            
            //create account username as a session variable
            
            
            //username fm database
            $username= $user["username"];
            $_SESSION["username"]=$username;
            
            //create account email a session variable
            $email=$user["email"];
            $_SESSION["email"]=$email;
            
        }
    }
    else{
        $errors["account"] = "There is no user user with these credentials";
    }
    
}
//print_r($errors);
//echo <br> $message;
?>
<!doctype>
<html>
    
    <head>
       <?php 
            $page_title="Login to your Account";
            include("includes/head.php");
        ?> 
        
    </head>
    <body>
        <?php include("includes/navigation.php"); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4" >
                    <form id="login-form" action="login.php" method="post">
                        <h1>Login to your Account        </h1>
                        <div class="form-group">
                            <label for="user" > Email Address or Username</label>
                            <input class="form-control" type="text" id="user" name="user" placeholder="you@email.com or username">
                        </div>
                         <div class="form-group">
                            <label for="password" > Your Password</label>
                            <input class="form-control" type="password" id="password" name="password" placeholder="your password">
                        </div>
                        <p>Don't have an account? <a href="register.php">Sign Up</a></p>
                        <div class="text-center">
                            <button type="submit" name="submit" value="login" class="btn btn-info">
                                Login</button>
                        </div>
                        
                    </form>
                    <?php
                        if(count($errors) > 0 || $message ){
                        //see which classs to be used with alert
                            if(count($errors) > 0){
                                $class="alert-warning";
                                //implode converts ur array into string
                                $feedback = implode(" ",$errors);
                            }
                            if($message){
                                $class="alert-success";     
                                $feedback = $message;
                            }
                            
                          //  echo "<div class=\"alert alert-warning\">
                          //      Test warning
                          //  </div>";
                            
                              echo "<div class=\"alert $class\">
                                $feedback
                              </div>";
                            
                        }
                    ?>
                    
                </dic>
            </div>
        </div>
    </body>
</html>