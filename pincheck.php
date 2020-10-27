<?php
//session start
session_start();
//if pin invalid return to pin create.
if(!isset($_SESSION["pin"])) {
  echo"Get a PIN";
  header("refresh: 4; url=pincreate.php");
  exit();
 }
 
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors',1);
//inlcude the myfunctions
include("myfunctions.php");
//Conects to database.
$db = mysqli_connect($hostname, $username, $password, $project);

if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
print "Successfully connected to MySQL.<br><br>";

mysqli_select_db( $db, $project ); 
//checks pin $_SESSION["pin"],$_GET["pin"]

$pin = safe( "pin");      
if($_SESSION["pin"]!=$pin)
{
//reddirect  pincreate.php
  echo"Bad PIN";
  header("refresh: 4; url=pincreate.php");
  exit();
}else
{
  $_SESSION["pinpassed"]=true;
  echo" Good PIN. Redirecting to service1.php";
  header("refresh: 4; url=service1.php");
  exit();
 
}

?>

