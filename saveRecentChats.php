
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
	  echo '<script>location.href="logIn.php";</script>';
}

?>



<?php

#get the user's id

extract ($_GET);



	#check if the query string is empty

	if(empty($p_u_id)){
		die("An Error occured!");
	}

	$user_id=@mysqli_real_escape_string($conn,parse_inputs($p_u_id));
	@date_default_timezone_set("Africa/Lagos");
	$timeUpdated=date("d/m/y")." - ".date("h:i:s:a");
	$user_msg_query=" ";
	#check for duplicate 
	$check_duplicate="SELECT * FROM recent_messaged_user WHERE User_ID ='$user_id' AND receiver_ID = '$ID' ";
	$check_duplicate_result=@mysqli_query($conn,$check_duplicate);

	if(!$check_duplicate_result){
		die("error".mysqli_error($conn));
	}else{
		#check if there is a duplicate
		if(mysqli_num_rows($check_duplicate_result) > 0){

			$user_msg_query="UPDATE recent_messaged_user SET date_added ='$timeUpdated' WHERE receiver_ID = '$ID'";

			
		}else{
			#insert the current user id into the recent messaged user table
			$user_msg_query="INSERT INTO recent_messaged_user (User_ID,receiver_ID,date_added) VALUES ('$user_id','$ID','$timeUpdated')";
		}
	}
	
	$insert_user_msg_result=@mysqli_query($conn,$user_msg_query);

	#check if there was an error
	if(!$insert_user_msg_result){
		
		die("error".mysqli_error($conn));

	}else{
		echo "success";
	}



?>