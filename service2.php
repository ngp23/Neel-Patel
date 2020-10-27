<?php
//inlcudes the my functions.php
include("myfunctions.php");
//session start.
session_start();

//check is pin passed 
if(!isset($_SESSION["pinpassed"]))
{
 //If pin not provied then redirect to the pincreate page.
 	echo "Get a pin";
 	header("refresh: 4; url=pincreate.php");
    exit();
 }
//if pin passed then connects to database.
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors',1);

$db = mysqli_connect($hostname, $username, $password, $project);
//UCID from the session and Menu choice from user.

$ucid=$_SESSION["ucid"];
$menu=safe("menu");

//Check through the menu and perform the task.
switch($menu)
{
  case "LT":    
     echo"List of the transactions<br>";
     list_transactions($ucid,$db);  
     break;
  case "LA":
     list_Accounts($ucid,$db);
     break;
  case "D":
      echo "Deposit<br>";
      $type ="D";
      $account=safe("account");
      $amount=safe("amount");
      deposit($ucid,$account,$amount,$db);
      echo"Done with perform transaction.";
      break;
  case "C":
      echo"Clear<br>";
      $account=safe("account");
      clear($ucid,$account,$db);
      break;
  case "W":
      echo "Withdraw<br>";
      $type ="W";
      $account=safe("account");
      $amount=safe("amount");
      withdraw($ucid,$account,$amount,$db);
      //echo"<br>Done with perform transaction.";
      break;     
  default:
		echo "Invalid menu choice <br>";
		break;
}

?>
<html>
<!--Creates an back button to access the menu options.-->
<a href = "service1.php"><br><br>Back</a>
</html>
