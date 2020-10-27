<?php
//creates an session
session_start();
//if login with incorrect credintials then redirect.
if(!isset($_SESSION["logged"])) {
  echo"Please Login";
  header("refresh: 4; url=auth.html");
  exit();
 }

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors',1);

//emails random pin to email address.
$pin=mt_rand(10000,100000);
$_SESSION["pin"]=$pin;
$to ="ngp23@njit.edu";
$subject="PIN";
$message=$pin;
echo "<br>$pin";
mail($to,$subject,$message);

?>

<meta charset="UTF-8">
<style>
   #F3{border: 2px solid red;padding:25px; width:50%;
    margin:100px 40px 65px;text-align:center;}

</style>
<!--Let you enter the pin -->
<form action ="pincheck.php" id="F3">
    <label for = "pin">Enter Pin:</label>
    <input type = text name = "pin" autocomplete="off"><br> 
    <input type = submit>
</form>