<style>

.status_online_nav{
	width:15px;
	height:15px;
	outline:2px solid white;
	background:green;
	position:absolute;
	transform:translateX(25px);
}
.status_offline_nav{
	width:15px;
	height:15px;
	outline:2px solid white;
	background:grey;
	position:absolute;
	transform:translateX(25px);
}

.dashboard{
	overflow:scroll;
}

.d-btn{
	background:#121212;
	border-color:white;
	color:black;

}


  ::-webkit-scrollbar{
    width:7px;
    height:7px;
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

   .img{
   		 background-color:white;
   	 	 border-radius:50%;
   	 	 float:left;
   	 	 height:20px;
   	 	 width:20px;
   	 	 

   }


   .img_update{

   }

</style>
<?php

require_once "conn.php";

if(!empty($_SESSION["ID"])){
	#this means someone is logged in
	$ID=$_SESSION["ID"];
	$query="SELECT * FROM users WHERE ID = $ID";
	$result=mysqli_query($conn,$query);
	$row=mysqli_fetch_assoc($result);

	#perform another query
	$user_info_query="SELECT * FROM users_info WHERE U_ID = '$ID'";
	$user_info_result=mysqli_query($conn,$user_info_query);
	$user_info_row=mysqli_fetch_assoc($user_info_result); 


	

}else{
	#header("Location: login.php");

	echo '<script>
		location.href="logIn.php";
	</script>';

 }

echo '<div class="dashboard text-left p-3  w-25  shadow">
<br/>
<br/>
'.'<img src='."profilePic/".$user_info_row["profile_picture"]. ' class=" rounded-circle" id="profilePic" height="40" width="40">'.'

<h4 class="text-capitalize text-center text-light">welcome '.$row["user_name"].'</h4>
<div class="menu-items row d-flex  flex-column justify-content-center align-items-center m-3">

<br/>
<button class="update-profile btn btn-primary text-capitalize text-light d-btn"><img src="'.end($all_images).'" id="img_update" class="img img_update">Update-Profile</button>
<br/>
<button class="take-cbt btn btn-primary text-capitalize text-light d-btn"> <img src="'.$all_images[7].'" id="img_test" class="img img_test"/>Take-Cbt</button>
<br/>
<button class="log-out btn btn-primary text-capitalize text-light d-btn"><img src="'.$all_images[4].'" id="log_out" class="img img_log_out">log-out</button>
<br/>
<button class="contact-admin btn btn-primary text-capitalize d-btn" id="contactAdmin"><img src="'.$all_images[2].'" id="contact_admin" class="img img_contact_admin"><a href="contactAdmin.php" class="text-capitalize text-center text-light text-decoration-none">Contact Admin</a></button>
<br/>
<button class="view-profile btn btn-primary text-capitalize text-light d-btn"><img src="'.$all_images[5].'" id="view-profile" class="img img_view_profile">View Profile</button>
<br/>
<button class="find-users btn btn-primary text-capitalize text-light d-btn"><img src="'.$all_images[3].'" id="find_users" class="img img_find_users">Find Users</button>

<br/>
<button class="message-users btn btn-primary text-capitalize d-btn"><img src="'.$all_images[1].'" id="message_users" class="img img_message_users"><a href="showUsers.php" class="text-capitalize text-light text-decoration-none ">Message Users</a></button>

<br/>

<br/>
</div>
</div>';


?>