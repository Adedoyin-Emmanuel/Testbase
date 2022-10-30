<?php
require "conn.php";   

if(!empty($_SESSION["ID"])){
	#this means someone is logged in
	$ID=$_SESSION["ID"];
	$query="SELECT * FROM users WHERE ID = $ID";
	$result=mysqli_query($conn,$query);
	$row=mysqli_fetch_assoc($result);

    $user_info_query="SELECT * FROM users_info WHERE U_ID = $ID";
    $user_query_result=mysqli_query($conn,$user_info_query);
    $user_info_row=mysqli_fetch_assoc($user_query_result);



}else{
	echo '<script>location.href="logIn.php"</script>';
}

// if(!empty($_SESSION["admin-ID"])){
//     header("Location: adminDashboard.php");
// }else{
//     header("Location: login.php");
// }
 


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="bootstrap.css">
<script src="jquery.js"></script>
<script src="sweetAlert2.js"></script>

<link rel="stylesheet" href="msgConfig.css">


<title>Message Notification</title>

<style>
	body{
		background:#121212;
		color:white;
	}

::-webkit-scrollbar{
    width:5px;
    height:5px;
    background:#121212;

  }

  ::-webkit-scrollbar-thumb{
    border-radius:20px;
    opacity:.7;
    background:dodgerblue;
    width:2px;
  }

   ::-webkit-scrollbar-button{
    display:none;
   }

   ::-webkit-scrollbar-corner{
    display: none;
   }

       @media  (max-width: 765px) {
       		
       		#content-contain{
       			flex-direction: column;
       			align-items: center;
       			justify-content: center;

       		}	
       }

 
</style>
</head>


<?php

#get the new message from the dbase


$get_new_message_query="SELECT * FROM users_msgs WHERE User_ID = '$ID'";
$get_new_message_result=@mysqli_query($conn,$get_new_message_query);

#check if the connection is well
if(!$conn){
	die("<h4 class='text-capitalize text-center m-auto text-danger'>error, connection is down!</h4>");
}


if(!$get_new_message_result){
	die("<h4 class='text-capitalize text-center m-auto text-danger'>error, connection is down!</h4>");
}else{
	#$row =mysqli_fetch_array($get_new_message_result);
	#check if the server returned empty result
	if(mysqli_num_rows($get_new_message_result) > 0){
		while($row=mysqli_fetch_array($get_new_message_result)){
			echo $row["message"];
			echo mysqli_num_rows($get_new_message_result);
		}
	}else{
		die("<h4 class='text-capitalize text-center m-auto text-danger'>Server returned empty result!</h4>");
	}
}


?>
<body class="text-light">

	<div class="container-fluid"></div>

</body>

</html>