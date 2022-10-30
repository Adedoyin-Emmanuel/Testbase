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
	  background:#121212;
}


  ::-webkit-scrollbar{
    width:7px;
    height:7px;
    background:#dc3545;

  }

  ::-webkit-scrollbar-thumb{
    border-radius:20px;
    opacity:.7;
    background:#dc3545;
    width:2px;
  }

   ::-webkit-scrollbar-button{
    display:none;
   }

   ::-webkit-scrollbar-corner{
    display: none;
   }

   body{
   	background: #121212;
   }


   .btn:hover{
   		background: #dc3545;
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

   body{
    color:white;
    background:#121212;
   }


</style>
<?php

require_once "../conn.php";

if(!empty($_SESSION["Admin_ID"])){
	#this means someone is logged in
	$ID=$_SESSION["Admin_ID"];
	$query="SELECT * FROM admin WHERE ID = $ID";
	$result=mysqli_query($conn,$query);
	$row=mysqli_fetch_assoc($result);

	#perform another query
	$admin_info_query="SELECT * FROM admin_info WHERE A_ID = '$ID'";
	$admin_info_result=mysqli_query($conn,$admin_info_query);
	$admin_info_row=mysqli_fetch_assoc($admin_info_result); 

}else{
	header("Location: adminLogin.php");
 }

 $all_images_2=array("../images/change_user.png","../images/chat_user2.png","../images/contact.png","../images/example.png","../images/log_out.png","../images/search.png","../images/settings.gif","../images/male_user 2.png","../images/test.png","../images/update_user.png");



echo '<div class="dashboard text-left p-3 w-25 h-100 text-light shadow-lg  text-light d-none">

<br/>
<br/>
'.'<img src='."../profilePic/".$admin_info_row["profile_picture"]. ' class=" rounded-circle" id="profilePic" height="40" width="40">'.'

<h4 class="text-capitalize text-center text-light">welcome '.$row["user_name"].'</h4>
<div class="menu-items row d-flex  flex-column justify-content-center align-items-center m-3">

<br/>
<button class="update-profile btn  text-capitalize text-light btn-ad"><img src="'.end($all_images_2).'" id="img_test" class="img img_test"/>Update-Profile</button>
<br/>
<button class="admin-actions btn  text-capitalize  text-light">
<img src="'.$all_images_2[3].'" id="img_test" class="img img_test"/>Admin-Actions</button>
<br/>
<button class="log-out btn  text-capitalize text-light ">
<img src="'.$all_images_2[4].'" id="img_test" class="img img_test"/>log-out</button>
<br/>
<button class="manage-users btn   text-capitalize text-light">
<img src="'.$all_images_2[7].'" id="img_test" class="img img_test "/>Manage Users | Admin</button>
<br/>
<button class="view-profile btn   text-capitalize text-light">
<img src="'.$all_images_2[5].'" id="img_test" class="img img_test"/>View Profile</button>
<br/>
<button class="cbt-settings btn   text-capitalize text-light"><img src="'.$all_images_2[6].'" id="img_test" class="img img_settings"/>CBT Settings</button>
<br/>
<button class="cbt-settings btn   text-capitalize text-light">
<img src="'.$all_images_2[1].'" id="img_test" class="img img_test"/>user messages</button>
<br/>
<br/>
</div>
</div>';


?>