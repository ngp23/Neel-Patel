<?php
session_start();
//check is pin passed 
if(!isset($_SESSION["pinpassed"])) {
  echo"Please Get pin";
  header("refresh: 4; url=pincreate.php");
  exit();
 }
?>
<meta charset="UTF-8">
<style>
   #F1{border: 3px solid red; width:50%;
    margin:auto;}
    #account,#amount{display:none;}
</style>

<form action = "service2.php" id ="F1">
<!--Creates an menu-->
    <select name="menu" id = "menu">
        <option value = "S">Select </option>  
        <option value = "LT">List Transactions </option>
        <option value = "LA">List Accounts </option>
        <option value = "C">Clear </option>
        <option value = "D">Deposit</option>
        <option value = "W">Withdraw</option>
    </select><br><br>
   
    <div id="account"><input type = text name = "account" >account<br></div>
    <div id="amount"><input type = text name = "amount" >amount<br></div>

<input type = submit >

</form>


<script>
    
var ptrMenu = document.getElementById("menu")
    ptrMenu.addEventListener("change",F)

var ptrAccount = document.getElementById("account")
var ptrAmount = document.getElementById("amount")
function F()
{
    var v = this.value
    ptrAmount.style.display="none"
    ptrAccount.style.display="none"
    if(v=="C")
    {
        ptrAccount.style.display="block"
    }
    if(v=="LT"){;}
     if(v=="LA"){;}
    if(v=="D")
    {
        ptrAmount.style.display="block"
        ptrAccount.style.display="block"
    }
    if(v=="W")
    {
        ptrAmount.style.display="block"
        ptrAccount.style.display="block"
    }
}

</script>
