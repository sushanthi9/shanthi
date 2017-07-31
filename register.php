<?php

include("includes/database.php");

//PROCESS REGISTRATION WITH PHP
//print_r($_SERVER);
if($_SERVER["REQUEST_METHOD"]=="POST"){


         //   print_r($_POST);
        //get data from the form(each input's name attribute becomes $_POST["attribute value"])
        $errors=array();
        
        
        
        $username=$_POST["username"];
        
        //check username for errors
        if(strlen($username)>16){
            //create error message
            $errors["username"]="username too long";
        }
        if(strlen($username)<6){
            $errors["username"]=$errors["username"] ." " . "username too short";
        }
        
        if ($errors["username"]){
        $errors["username"]=trim($errors["username"]);
        }
        
        
        
        $email=$_POST["email"];
        
        //check email for errors
        $email_check= filter_var($email,FILTER_VALIDATE_EMAIL);
        if($email_check==false){
            $errors["email"]="email address is not valid";
        }
        
        
        $password1=$_POST["password1"];
        $password2=$_POST["password2"];
        
        if($password1 !== $password2){
            $errors["password"]="passwords are not equal";
        }
        //Check password length
        elseif(strlen($password1)<8){
            $errors["password"]="password should be atleast 8 characters long ";
        }


        //if no errors write data to database
        if(count($errors)==0){
            //hash the password
            $password=password_hash($password,PASSWORD_DEFAULT);
            //create a query string
            $query="insert 
                    into accounts
                    (name,email,password,status,created)
                    values
                    ('$username','$email','$password',1,NOW())";
                    $result=$connection->query($query);
                 //   var_dump(connection)
                 //   echo $query;
                    if($result==true){
                        echo " account created";
                    }
                    else{
                        if($connection->errno==1062){
                            echo $connection->error;
                            $message= $connection->error;
                                //check if error contains ""username"
                                if(strstr($message,"name")){
                                    $errors["username"]="username has been taken";
                                }
                                if(strstr($message,"email")){
                                    $errors["email"]="email has been taken";
                                }
                        
                        }
                    }
        }
}
?>
<!doctype html>
<html>
<?php 
    $page_title="Register Account";
    include("includes/head.php");
?>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
             
                <form id="registration" action="register.php" method="post">
                <div class="text-center">
                    <h2> Register AN Account</h2>
                    <!--username-->
                    <?php
                        if($errors["username"]){
                            $username_error_class="has-error";
                        }
                    ?>
                    <div class="form-group <?php echo $username_error_class; ?>">
                        <label for="username">Username</label>
                        <input class="form-control" name="username" type="text"  id="username" placeholder="minimum 6 characters" value="<?php echo $username;?>">
                        <span class="help-block">
                            <?php echo $errors["username"]; ?>
                        </span>
                    </div>
                    <!-- email-->
                    <?php
                         if($errors["email"]){
                            $email_error_class="has-error";
                        }
                    ?>
                    <div class="form-group <?php echo $email_error_class; ?>">
                         <label for="email">Email</label>
                        <input class="form-control" name="email" type="email"  id="email" placeholder="you@domain.com" value="<?php echo $email; ?>">
                        <span class="help-block">
                            <?php echo $errors["email"]; ?>
                        </span>
                    </div>
                    <!-- password-->
                     <?php
                         if($errors["password"]){
                            $password_error_class="has-error";
                        }
                    ?>
                    <div class="form-group <?php echo $password_error_class; ?>">
                        <!--password 1-->
                         <label for="password1">Password</label>
                        <input class="form-control" name="password1" type="password"  id="password1" placeholder="mininum 8 characters">
                        <!--password 2-->
                         <label for="password2">Password</label>
                        <input class="form-control" name="password2" type="password"  id="password2" placeholder="mininum 8 characters">
                        
                        
                         <span class="help-block">
                            <?php echo $errors["password"]; ?>
                        </span>
                            <button type="submit" class ="btn-btn-default">Register</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    
    
</body>

</html>