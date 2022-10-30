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

#get the user_id from the URL

# $user_id=mysqli_real_escape_string($conn,parse_inputs($_GET["u_id"]));


extract($_GET);

#check if the the u_id is set

if(isset($u_id)){
	$_SESSION["ad_u_id"]=$u_id;
	header("Location: adminShowUserComplains.php");
}else{
// 	header("Location: adminNotifications.php");
 }



 $get_user_info_query="SELECT * FROM users_info WHERE U_ID = $_SESSION[ad_u_id]";
 $get_user_info_result=mysqli_query($conn,$get_user_info_query);
 $user_info_row=mysqli_fetch_array($get_user_info_result);


$get_user_complain="SELECT * FROM admin_msgs WHERE User_ID = $_SESSION[ad_u_id] ";
$get_user_complain_result=mysqli_query($conn,$get_user_complain);
$get_user_complain_row=mysqli_fetch_array($get_user_complain_result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="../bootstrap.css">
<link rel="stylesheet" href="adminPageNav.css">

<script src="../bootstrap.js"></script>
<script src="../jquery.slim.min.js"></script>
<script src="../sweetAlert2.js"></script>   

<link rel="stylesheet" href="../msgConfig.css"/>

<style>
    .rounded-circle{
        transform:translate(60px,40px);
    }


    .notify_icon{
       height:25px;
       width:25px;  
       font-size:14px;
       text-shadow:1px 1px 1px black;
       transform:translateY(-10px);

       display:flex;
       justify-content:center;
       align-items:center;
      


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

   body{
    background: #121212;
    color:white;
   }

   .img{
    border-radius: 50%;
    display: flex;
    align-items:flex-end;
    justify-content: flex-end;
    position: absolute;
    right:8%;
   }

   .date_added{

   }

  .div-round{
    border-radius:50%;
  }




    
</style>
<title>Admin User Notification</title>
</head>
<body class="text-light">

<div class="container-fluid p-0 m-auto text-capitalize ">
  <?php require_once "adminNav.php";?>
    <section class="text-capitalize p-4 m-auto text-center ">
        <br/>
        <br/>

    <?php
         #$user_online_status=false;
         if($row["status"] == 1){
             
             echo '<img src="../profilePic/'.$admin_info_row["profile_picture"].'"'.'height="50" width="50" class=" div-round m-auto" alt="profile_pic"';
         }else{
           
            echo '<img src="../profilePic/'.$admin_info_row["profile_picture"].'"'.'height="50" width="50" class="div-round m-auto" alt="profile_pic"';
         }
        ?>

        <br/><br/>
            <h2 class="text-capitalize text-center p-3" >welcome <?php echo $admin_info_row["user_name"]?></h2>







<div class="text-capitalize bg-dark text-white p-5 rounded shadow d-flex flex-row align-items-start justify-content-center flex-wrap ">

<div class="text-capitalize  text-white d-flex flex-column flex-wrap">
		<div class="">
		<h5 class="text-center text-capitalize text-light">Welcome Chief ⚡⚡</h5>
	<br/>
	<h6>dear <?php echo $admin_info_row["user_name"]?>, <?php echo $user_info_row["user_name"]?> left a message for you</h6>
	<br/>
	<button class="btn btn-danger" id="read_message">Read Message</button>
	<br/>
	<br/>
	<div class="text-capitalize text-light d-none" id="read_user_msg">
	<?php echo $get_user_complain_row["message"]?>
<br/><br/>
	<h6>check the box if you have read the user's complaint</h6>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
	<input type="checkbox" name="marked_as_read" id="check">
	</div>

		
	<br/>

	<button class="btn btn-danger text-center text-capitalize d-none" id="submit_marked_msg" name="submit_marked_msg">submit and proceed</button>
</form>
<br/><br/>
<button class="btn btn-primary text-center text-capitalize text-light" id="back"><a class="text-decoration-none text-center text-capitalise text-light" href="adminNotifications.php">Back</a></button>
<!-- <br/><br/> -->
		</div>



<script>
	
	$(document).ready(($)=>{
		$("#read_message").click(()=>{
			let $read_user_msg=$("#read_user_msg");
				$read_user_msg.removeClass("d-none");
				$read_user_msg.addClass("d-block");

		$("#read_message").addClass("d-none");
		$("#submit_marked_msg").removeClass("d-none");

		});


		//check if the admin submitted the form
		// $("form").submit((e)=>{
		// 	e.preventDefault();
		// //check if the checkbox is checked or not
		// 	if($("#check").checked()){

		// 	}
		// });
	});
</script>


<?php

if(isset($_POST["submit_marked_msg"]) AND $_SERVER["REQUEST_METHOD"] == serverMethod){
	#check if the checkbox is empty
	$checked=false;
	 if(!empty($_POST["marked_as_read"])){
	 	$checked=true;
	 }else{
	 	$checked=false;
	 }


	 #preare the query
	 if($checked){
	 	$update_user_complains_query="DELETE FROM admin_msgs WHERE User_ID=$_SESSION[ad_u_id]";
	 	$update_user_complains_result=@mysqli_query($conn,$update_user_complains_query);

	 	#check if there wa an error
	 	if(!$update_user_complains_result){
	 		echo "<script>

	 		swal.fire({
	 			title:'Error',
	 			text:'An error occured, please try again',
	 			icon:'error'
	 		});

	 		</script>";

	 		die();
	 	}else{
	 		echo "<script>

	 		swal.fire({
	 			title:'success',
	 			text:'Message marked as read, proceed to dashboard',
	 			icon:'success',
	 			allowOutsideClick:false,
	 			allowEscapeKey:false,
	 			confirmButtonText:'Proceed To Dashboard'
	 		}).then((willProceed)=>{
	 			if(willProceed.isConfirmed){
	 				location.href='index.php';
	 			}else{
	 				location.href='index.php';
	 			}
	 		});

	 		</script>";
	 		#echo '<script>location.href="index.php"</script>';

	 	}

	 }
}



?>
</div>

</div>




</div>





</body>
<script src="adminPageNav.js"></script>
</html>
