<?php
require "conn.php";


if(!empty($_SESSION["ID"])){
	#this means someone is logged in
	$ID=$_SESSION["ID"];

}
#update the user status on the database
$logout_query="UPDATE users SET status =0 WHERE ID ='$ID';";
$logout_query.="UPDATE users_info SET status =0 WHERE U_ID ='$ID'";

$logout_result=mysqli_multi_query($conn,$logout_query);

if($logout_result){
	
#make the cookies expire 
setcookie("login",time()-3600);
setcookie("user_name",time()-3600);
setCookie("ID",time()-3600);
#destroy the current user session
#set the session array to an empty array

session_unset($ID);
session_destroy();

#navigate the user back to the login page
header("Location: login.php");

}



?>