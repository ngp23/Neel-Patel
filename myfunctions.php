<?php
include("account.php");
 
function list_transactions($ucid,$db)
{
    //creates the path for the sql statement
    $s= " select * from transactions where ucid='$ucid' ";
    //secures the connection or it dies.
    ($t=mysqli_query($db,$s)) or die(mysqli_error($db));
    //Loop to connect reteve all the data from the table for the user.
    while( $r=mysqli_fetch_array($t,MYSQLI_ASSOC)){
       $timestamp=$r["timestamp"];
       $account =$r["account"];
       $amount=$r["amount"];
       $amountAfter = money_format ('%=#1.2n', $amount)."\n";
       //Prints out the ucid, account number, amount and timestamp.
       echo "<b>ucid: $ucid ||";
       echo " account: $account ||";
       echo " amount: $amountAfter  ||";
       echo " timestamp: $timestamp<br>"; 
    }   
}

function deposit($ucid,$account,$amount,$db)
{
	//Makes deposit using this method.
	$s=" update accounts set balance = balance+'$amount',
		mostRecentTransaction = NOW()
		where 
		ucid='$ucid'    and 
		account ='$account'   and  
		balance + '$amount' >= 0.00"; 
	// echo "<br>sql update = $s";
	($t=mysqli_query($db,$s)) or die(mysqli_error($db));
	//insert transaction			
	$s= "insert into transactions values ( '$ucid','$account','$amount',NOW( ))";			
	echo "<br>sql insert = $s";
	($t=mysqli_query($db,$s)) or die(mysqli_error($db));
	echo "<br>sql insert = succeeded<br>";
}
function withdraw($ucid,$account,$amount,$db)
{
	
	$amount=$amount*-1; 
	$s=" update accounts Set balance = balance+'$amount',
		 mostRecentTransaction = NOW()
		 where 
		 ucid='$ucid'    and 
		 account ='$account'   and  
		 balance + $amount  >= 0.00";

	// echo "<br>sql update = $s";
	($t=mysqli_query($db,$s)) or die(mysqli_error($db));
	 //insert transaction
	 $row = mysqli_affected_rows($db);
	 if($row !=0)
	{
	    $s= "insert into transactions values ( '$ucid','$account','$amount',NOW( ))";
		 echo "<br>sql insert = $s";
		 ($t=mysqli_query($db,$s)) or die(mysqli_error($db));
		 echo "<br>sql insert = succeeded<br>";
		 echo"<br>Withdrawal Was succesfully done.";
	}
	 else{echo "<br>Overdraft rejected. "; return;}
}

//purpose: Validate(return true or false)depending on wherther ucid&pass are valid.
function authenticate($ucid,$password,$db  ){
    $s= " select * from users where ucid='$ucid' and pass = '$password'";
    //echo "<br>sql select: $s";
    ($t=mysqli_query($db,$s)) or die(mysqli_error($db));
   //exit if the password and user doesnt match.
    $count=mysqli_num_rows($t);
    echo "<br>count: $count";
    if($count == 0){return false;};
    echo "<br>Continue ";
    return true;
    
}
//Safe function for the input.
function safe($fieldname)
{
  global $db;
  $temp=$_GET[$fieldname];
  $temp=trim($temp);
  $temp=mysqli_real_escape_string($db,$temp);
  //echo "<br>$fieldname is: $temp<br>";
  return $temp;
}
function clear($ucid,$account,$db)
{
    $s= "DELETE FROM transactions WHERE ucid='$ucid'and account='$account' ";
    //secures the connection or it dies.
    ($t=mysqli_query($db,$s)) or die(mysqli_error($db));
    $s=" update accounts set balance = 0.00,
       mostRecentTransaction = NOW()
       where 
       ucid='$ucid'    and 
       account ='$account' ";
    ($t=mysqli_query($db,$s)) or die(mysqli_error($db));
    echo "Delete Succesful.<br>";
}

function list_Accounts($ucid,$db)
{
  $s="select*from accounts where ucid='$ucid'";
  ($t=(mysqli_query($db,$s))or die (mysqli_error($db)));
  echo"<br>List of accounts of $ucid is :<br>";
  while($r=mysqli_fetch_array($t,MYSQLI_ASSOC))
  {
    $account = $r["account"];
    echo "<br>Account for Number is :$account";
  }
}

?>