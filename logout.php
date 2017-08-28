<?php 
//unset session variables
//to access session in this page,it needs to be started in this page 
//session has to be started in every page that we want to use it in
session_start();
//unset variables
unset($_SESSION["username"]);
unset($_SESSION["email"]);

// redirect user to home page
header("location: index.php");
?>
