<?php 
// $dbuser ="user";
// $dbpassword="password";
// $dbhost="localhost";
// $dbdatabase="datbase";

//using env variables for security
//this way our code will not contain confidential data but if we are moving the project then we need to set the env variables again
$dbhost = getenv("dbhost");
$dbuser = getenv("dbuser");
$dbpassword = getenv("dbpassword");
$dbdatabase = getenv("dbname");

$connection=mysqli_connect($dbhost,$dbuser,$dbpassword,$dbdatabase);
if(!$connection){
    echo "database error";
}
?>