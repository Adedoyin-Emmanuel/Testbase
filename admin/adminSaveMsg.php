<?php
require "../conn.php";

if(!empty($_SESSION["Admin_ID"])){
	#this means someone is logged in
	$ID=$_SESSION["Admin_ID"];
	$query="SELECT * FROM admin WHERE ID = '$ID'";
	$result=mysqli_query($conn,$query);
	$row=mysqli_fetch_assoc($result);


    
    $admin_info_query="SELECT * FROM admin_info WHERE A_ID = $ID";
    $admin_query_result=mysqli_query($conn,$admin_info_query);
    $admin_info_row=mysqli_fetch_assoc($admin_query_result);



}else{
	header("Location: adminLogin.php");
}



?>

<?php


#get the query string from ajax call

$typed_msg=@mysqli_real_escape_string($conn,parse_inputs($_GET["msg"]));

if(empty($typed_msg)){
	die("Error, Cannot Save Message");
}



#prepare the date and time the message was sent 
$date_time=date("d/m/y")." - ".date("h:i:s:a");

#the save msg query would save the both the user message and the admin messages together 

#here the admin can be the user and can also be the receiver
$save_msg_query="INSERT INTO admin_user_msgs (User_ID,Receiver_ID,message,date_added) VALUES ('$ID','$_SESSION[admin_receiver_id]','$typed_msg','$date_time')
";

$save_msg_result=@mysqli_query($conn,$save_msg_query);

if(!$save_msg_result){
	die("An Error Occured While Saving Messages");

}


$typed_msg = "";






?>