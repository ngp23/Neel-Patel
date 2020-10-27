<?php
//Session start.
session_start();

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors',1);

setlocale(LC_MONETARY, 'en_US');
//gets information from the account.php and myfunctions.php
include ( "account.php" ) ;
include("myfunctions.php");
//connects to the mysql.

$db = mysqli_connect($hostname, $username, $password, $project);

if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
print "Successfully connected to MySQL.<br><br>";

mysqli_select_db( $db, $project ); 

// Gets the data from the user
$ucid = safe("ucid");     
$password = safe( "password");      

$delay=4;

if (!authenticate($ucid,$password,$db)){
  //redirect to the login page
  echo"Invalid. Redirecting to the form";
  header("refresh: 3; url=auth.html");
  exit();
}else{
  //redirect  to the next page
  $_SESSION["logged"]=true;
  $_SESSION["ucid"]=$ucid;
  echo"Valid. Redirecting to pincreate.php";
  header("refresh: 3; url=pincreate.php");
  exit();
;}

?>