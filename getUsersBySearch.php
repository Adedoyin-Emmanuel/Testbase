
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
    $user_info_row=mysqli_fetch_array($user_query_result);

 


}else{
	header("Location: login.php");
}

?>



<?php

	extract($_GET);

	$user_search=@mysqli_real_escape_string($conn,parse_inputs($user_name));

	#check if the user's_search is empty
	if(empty($user_search)){
		die("<p class='text-danger my-1'>error, enter a legit username</p>");
	}

	$status=1;


	$get_user_query="SELECT * FROM users_info WHERE NOT U_ID ='$user_info_row[0]'  AND user_name LIKE '%$user_search%' AND status =  '$status'";
	$get_user_result=mysqli_query($conn,$get_user_query);


	#check if there was an error
	if(!$get_user_result){
		die("an error occured".mysqli_error($conn));
	}else{
		if(mysqli_num_rows($get_user_result) > 0){

		while($user_row=mysqli_fetch_array($get_user_result)){

		
		

			#set the user;s default status
				$default_status="offline";

				($user_row["status"] == 1) ? $default_status ="online" : $default_status = "offline";

				$data= '
				     	<a  href="messageUser.php?receiver_id='.$user_row["U_ID"].'" class="text-decoration-none text-light d-block bg-primary px-5 py-3 rounded-3 my-4 w-100">
				     		<div class="d-flex flex-wrap align-items-start justify-items-around flex-column ">

				     		<p class="text-capitalize text-start small">'.$default_status.'</p>

				     			<div class="d-flex flex-row-reverse align-items-center justify-items-evenly">

				     			<p class="text-capitalize text-center text-light px-2">'.$user_row["user_name"].'</p>



				       				 <img src="profilePic/'.$user_row["profile_picture"].'" height="40" width="40" class="img d-block rounded-circle"/>

				     			</div>

				     		</div>



				     	</a>
		       		';

		      echo $data;

				}
		}else{

			#empty result no result found
		}
	}



?>