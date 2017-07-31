<?php 
$user ="user";
$password="password";
$host="localhost";
$database="datbase";
$connection=mysqli_connect($host,$user,$password,$database);
if(!$connection){
    echo "database error";
}
?>