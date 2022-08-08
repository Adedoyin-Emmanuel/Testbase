
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
	header("Location: login.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="bootstrap.css">
<!-- <link rel="stylesheet" href="style.css"> -->

<script src="bootstrap.js"></script>
<script src="jquery.slim.min.js"></script>
<script src="sweetAlert2.js"></script>
<noscript>This application requires javaScript to run</noscript>
<link rel="stylesheet" href="msgConfig.css"/>
<title>Find Users</title>

<style>
    .status_online{
	width:15px;
	height:15px;
	outline:2px solid white;
	background:green;
	transform:translate(57px,-8px);

    
	
}
body{
    background:ghostwhite;
}



.status_offline{
	width:15px;
	height:15px;
	outline:2px solid white;
	background:grey;
	transform:translate(57px,-8px);
	
}
.errorLog{
    display:none;
}




</style>
</head>
<body>
<?php require_once "nav.php";?>
<br/>
<div class="d-flex align-items-center justify-content-around flex-row-reverse ">
<div class="data-area w-50 text-capitalize "id="data-area">
    <div class="d-flex justify-content-center align-items-center p-1 profile_card ">
        <?php
         #$user_online_status=false;
         if($row["status"] == 1){
             echo ' <div class="rounded-circle status_online" ></div>';
             echo '<img src="profilePic/'.$user_info_row["profile_picture"].'"'.'height="50" width="50" class="rounded-circle alt="profile_pic" "';
         }else{
            echo ' <div class="rounded-circle status_offline" ></div>';
            echo '<img src="profilePic/'.$user_info_row["profile_picture"].'"'.'height="50" width="50" class="rounded-circle alt="profile_pic" "';
         }

            #create a variable to keep track of the search result
            $search_result_number=0;
        ?>
    <br/>
    <h3 class="text-capitalize text-center p-3" ><?php echo $row["user_name"]?></h3>
  
</div>
</div>
</div>

<?php

#get the user's id
$receiver_id=mysqli_real_escape_string($conn,parse_inputs($_GET["r_id"]));
#use the id to get the user information
$get_info_query="SELECT * FROM users_info WHERE U_ID = '$receiver_id'";
$get_info_result=mysqli_query($conn,$get_info_query);

#check if connection was successful
if(!$conn){
	die("<h3 class='text-center text-capitalize text-danger'>an error occured while getting user's data</h3>");
}


if(!$get_info_result){
	echo '<script>
		swal.fire({
			title:"fatal error",
			text:"an error occured",
			icon:"error"
		});
	</script>';
}


$result_row=mysqli_fetch_assoc($get_info_result);


?>
<h3 class="text-capitalize p-2 text-center">Send a message</h3>
<div class="errorLog rounded p-2 justify-content-center align-items-center text-center text-capitalize text-light" id="errorLog" style="background:tomato;"></div>
<div class="chat_box m-auto">
	<div class="receiver_profile_details d-flex flex-column">
		<h5 class="text-capitalize text-center">adedoyin emmanuel</h5>
		<p class="user_status p-2">offline</p>
		<!-- specifies weather the user is new or an -->
		<p class=" p-2">newbie</p>


	</div>


	<div class="chat_form m-auto w-75">
		<form class="form " method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
			<input type="text" name="user_id" hidden>

			<input type="text" name="incoming_msg" id="incoming_msg" hidden>

			<input type="text" name="outgoing_msg" id="outgoing_msg" class="form-control p-5" placeholder="Please type your message for the user here...">
			

<br/>
<br/>
			<button type="submit" class="btn btn-primary p-2 text-capitalize text-center m-2">send message</button>
		</form>

 
   </div>

</div>