<?php 
$dbuser ="user";
$dbpassword="password";
$dbhost="localhost";
$dbdatabase="datbase";
$connection=mysqli_connect($dbhost,$dbuser,$dbpassword,$dbdatabase);
if(!$connection){
    echo "database error";
}
?>