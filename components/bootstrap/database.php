<?php 
$user ="sushanthi";
$password="password";
$host="localhost";
$database="database";
$connection=mysqli_connect($host,&user,$password,$database);
if(!$connection){
    echo "database error";
}
?>