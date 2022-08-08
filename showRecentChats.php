
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
    #redicrect the user to login
    echo '<script>

        location.href="login.php";
    
        </script>';
}

?>



<?php



	$get_current_users="SELECT DISTINCT  * FROM recent_messaged_user ORDER BY ID DESC";
	$get_result=mysqli_query($conn,$get_current_users);
    


	if(!$get_result){
		die('<h4 class="text-capitalize text-danger text-center">server returned 0 result</h4>');
	}else{

	

		
			#get the user id
			echo '<h4 class="text-start p-3 text-capitalize text-light my-3">Recent Chats</h4>';
		while($users_row=mysqli_fetch_array($get_result)
		){

			#user the user's id from the users row to get the users' information
 
		$get_user_info_query="SELECT * FROM users_info WHERE U_ID = '$users_row[1]'";
		$get_user_info_result=mysqli_query($conn,$get_user_info_query);

		$recent_user_row=mysqli_fetch_array($get_user_info_result);
		#check if there was an error
		if(!$get_user_info_result){
			die("an error occured, could not get the user's info".mysqli_error($conn));
		}

			#set the user;s default status
				$default_status="offline";

				($recent_user_row["status"] == 1) ? $default_status ="online" : $default_status = "offline";

				$data= '
				     	<a a href="messageUser.php?receiver_id='.$users_row["User_ID"].'" class="text-decoration-none text-light d-block bg-primary px-5 py-3 rounded-3 my-4">
				     		<div class="d-flex flex-wrap align-items-start justify-items-around flex-column">

				     		<p class="text-capitalize text-start small">'.$default_status.'</p>

				     			<div class="d-flex flex-row-reverse align-items-center justify-items-evenly">

				     			<p class="text-capitalize text-center text-light mx-3">'.$recent_user_row["user_name"].'</p>



				       				 <img src="profilePic/'.$recent_user_row["profile_picture"].'" height="40" width="40" class="img d-block rounded-circle"/>

				     			</div>

				     		</div>



				     	</a>
		       		';

		      echo $data;
		}

		 

		
		
	}



?>