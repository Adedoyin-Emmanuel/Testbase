<?php
require_once "../conn.php";

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



<link rel="stylesheet" href="../msgConfig.css">

<title class="text-capitalize">Admin Dashboard</title>


<style>
  .notify_bar{
    width:160px;
    height:120px;
    padding-top:10px;

  }
    .img_right{
      float:right;
      background:white;
      border-radius:50%;
      height:20px;
      width:20px;

    }

    ::-webkit-scrollbar{
    width:5px;
    height:5px;
    background:#121212;

  }

  ::-webkit-scrollbar-thumb{
    border-radius:20px;
    opacity:.7;
    background:#121212;
    width:2px;
    color:#dc3545;
  }

 

   ::-webkit-scrollbar-button{
    display:none;
    background:#dc3545;

   }

   ::-webkit-scrollbar-corner{
    display: none;
    background:#dc3545;
   }

   body{
    background: #121212;
    color:white;
   }




</style>
</head>
<body class="text-light">

<div class="container-fluid p-0 text-light">
<?php require_once "adminNav.php";?>
<div class="d-flex align-items-center justify-content-around flex-row-reverse ">
<div class="data-area w-100  text-capitalize" id="data-area">
  <br/>
  <br/>
<div class="d-flex justify-content-center align-items-center p-4">
    
   <?php
         #$user_online_status=false;
         if($row["status"] == 1){
             echo ' <div class="rounded-circle status_online" ></div>';
             echo '<img src="../profilePic/'.$admin_info_row["profile_picture"].'"'.'height="50" width="50" class="rounded-circle alt="profile_pic" "';
         }else{
            echo ' <div class="rounded-circle status_offline" ></div>';
            echo '<img src="../profilePic/'.$admin_info_row["profile_picture"].'"'.'height="50" width="50" class="rounded-circle alt="profile_pic" "';
         }
        ?>
        <br/>
    <h2 class="text-capitalize text-center p-3" >welcome <?php echo $row["user_name"]?></h2>
</div>
<?php
  #check if the user has updated his/her profile or not
  $admin_update_profile_query="SELECT * FROM admin_info WHERE A_ID = $ID";
  $admin_update_profile_result=mysqli_query($conn,$admin_update_profile_query);
  $admin_update_profile_row=mysqli_fetch_assoc($admin_update_profile_result);


 $all_images_3=array("../images/change_user.png","../images/chat_user2.png","../images/contact.png","../images/example.png","../images/log_out.png","../images/search.png","../images/settings.gif","../images/male_user 2.png","../images/test.png","../images/notify.png","../images/update_user.png");

  #check if the query was successful
  if(!$admin_update_profile_result){
      echo "an unknown error occured";
  }else{
      if(mysqli_num_rows($admin_update_profile_result) > 0){
        #the query was successful and there is a record in the dbase
        #check if the user has updated the profile
        if($admin_update_profile_row["profile_updated"] == 1){
              echo " Welcome Back Admin ". $row["user_name"]." , you updated your profile details on... ". $admin_update_profile_row["time_updated"].", you can always change your profile details...";
              echo '
              <br/><br/><br/>
               <div class="d-flex justify-content-evenly align-items center  m-auto flex-xl-row">
               
               
               <button class="btn btn-dark text-center text-capitalize"> <a href="adminChangeProfile.php" class="text-decoration-none text-center text-light" >  change profile details <img src="'.end($all_images_3).'" id="img_test" class="img img_test text-center img-right"/></a> </button>
               <br/>
               <button class="btn btn-danger text-center text-capitalize"> <img src="'.$all_images_3[9].'" id="img_test" class=" img_test text-center img_right"/> <a href="adminNotifications.php" class="text-decoration-none text-center text-light">admin chat notications</a> </button>
               
               </div>
               <br/><br/>
                ';
        }else{
            echo "Admin ".$row["user_name"].", you have not updated your profile please click the button below to update your profile";
            echo '
            <br/><br/>
            <button class="btn btn-danger text-center text-capitalize"> <a href="adminProfileUpdate.php" class="text-decoration-none text-center text-light">update profile &gt;&gt;</a> </button>
            ';
        }
      }else{
        echo $row["user_name"].", you have not updated your profile please click the button below to update your profile";
            echo '
            <br/><br/>
            <button class="btn btn-danger text-center text-capitalize"> <a href="adminProfileUpdate.php" class="text-decoration-none text-center text-light">update profile &gt;&gt;</a> </button>
            ';
      }
  }
  



?>
<?php

#write a query to get the total users 
$default_profile_status=1;
$get_users_query="SELECT * FROM users_info WHERE NOT profile_updated = '$default_profile_status'";
$get_users_result=@mysqli_query($conn,$get_users_query);
$new_users=0;

if(!$get_users_result){
    echo '<script>
        swal.fire({
            title:"Error",
            text:"couldn`t retrive some data from the database",
            icon:"error"

        });
    
    </script>';
    die("error occured".mysqli_error($conn));
}else{
    $new_users=@mysqli_num_rows($get_users_result);
}

$get_user_complain="SELECT * FROM admin_msgs";
$get_user_complain_result=@mysqli_query($conn,$get_user_complain);
$user_complain=0;

if(!$get_user_complain_result){
    echo '<script>
        swal.fire({
            title:"Error",
            text:"couldn`t retrive some data from the database",
            icon:"error"

        });
    
    </script>';
    die("error occured".mysqli_error($conn));
}else{
    $users_complain=@mysqli_num_rows($get_user_complain_result);
}


$count_users_query="SELECT * FROM users";
$count_users_result=@mysqli_query($conn,$count_users_query);
$total_users=0;

if(!$count_users_result){
  die('<script>

          swal.fire({
            title:"an error occured",
            text:"cannot perform operation",
            icon:"error"
          });

    </script>');
}else{
  $total_users=mysqli_num_rows($count_users_result);
}


    #count test querry 
    $count_test_query="SELECT * FROM users_test";
    $count_test_result=@mysqli_query($conn,$count_test_query);
    
    #check if the connection was successsful
    if(!$conn){
         echo('<script>

          swal.fire({
            title:"Fatal Error!",
            text:"connection to server lost",
            icon:"error"
          });

    </script>');
        die("<h4 class='text-capitalize text-danger'>a fatal error occured.</h4>");
        
    }
    
    #check if the query was successful
    if(!$count_test_result){
          echo('<script>

          swal.fire({
            title:"Fatal Error!",
            text:"Server returned an error while processing request",
            icon:"error"
          });

    </script>');
        die("<h4 class='text-capitalize text-danger'>Could not get info from server</h4>");
        
    }
    
    $total_test_number=mysqli_num_rows($count_test_result);
    
    
    
     #count subject query 
    $count_subject_query="SELECT * FROM users_subjects";
    $count_subject_result=@mysqli_query($conn,$count_subject_query);
    
    #check if the connection was successsful
    if(!$conn){
         echo('<script>

          swal.fire({
            title:"Fatal Error!",
            text:"connection to server lost",
            icon:"error"
          });

    </script>');
        die("<h4 class='text-capitalize text-danger'>a fatal error occured.</h4>");
        
    }
    
    #check if the query was successful
    if(!$count_test_result){
          echo('<script>

          swal.fire({
            title:"Fatal Error!",
            text:"Server returned an error while processing request",
            icon:"error"
          });

    </script>');
        die("<h4 class='text-capitalize text-danger'>Could not get info from server</h4>");
        
    }
    
    $total_subject_number=mysqli_num_rows($count_subject_result);
?>

<h4 class="text-center text-capitalize notification">Admin notification</h4>
<div class="notify d-flex text-capitalize justify-content-evenly align-items-center flex-wrap mt-3 ">

<!-- notify bar 1-->
<div class="notify_bar  bg-dark text-light p-3  rounded-3 shadow mt-2 me-2 my-2">
<div class="notify text-capitalize">New users</div>
<br/>
<h4 class="text-light"><?php  echo $new_users; ?></h4>
</div>

<!-- notify bar 2-->

<div class="notify_bar  bg-dark text-light p-3  rounded-3 shadow mt-2 me-2 my-2">
<a href="adminNotifications.php" class="text-capitalize text-center text-light text-decoration-none">
<div class="notify text-capitalize">user complains</div></a>
<br/>
<h4 class="text-light"><?php echo $users_complain?></h4>
</div>
<!-- notify bar 3-->
<div class="notify_bar  bg-dark text-light p-3  rounded-3 shadow mt-2 me-2 my-2">
<div class="notify text-capitalize">Tests</div>
<br/>
<h4 class="text-light"><?php echo $total_test_number; ?></h4>
</div>
<!-- notify bar 4-->
<div class="notify_bar  bg-dark text-light p-3 rounded-3 shadow mt-2 me-2 my-2">
<div class="notify text-capitalize">news feed</div>
<br/>
<h4 class="text-light">8</h4>
</div>
<!-- notify bar 5-->
<div class="notify_bar p-3  mt-2 bg-dark text-light rounded-3 shadow me-2 my-2">
<div class="notify text-capitalize">Subjects</div>
<br/>
<h4 class="text-light"><?php echo  $total_subject_number; ?></h4>
</div>


<!-- notify bar 6-->
<div class="notify_bar bg-dark text-light p-3  rounded-3 shadow mt-2 me-2 my-2">
<div class="notify text-capitalize">Exam update</div>
<br/>
<h4 class="text-light">10</h4>
</div>

<!-- notify bar 7-->
<div class="notify_bar  bg-dark text-light p-3  rounded-3 shadow mt-2 me-2 my-2">
<div class="notify text-capitalize">Total users</div>
<br/>
<h4 class="text-light"><?php echo $total_users?></h4>
</div>


<!-- notify bar 8-->
<div class="notify_bar  bg-dark text-light p-3  rounded-3 shadow mt-2 me-2 my-2">
<div class="notify text-capitalize">Total Admin</div>
<br/>
<h4 class="text-light">1 </h4>
</div>

<!-- notify bar 8-->
<div class="notify_bar  bg-dark text-light p-3  rounded-3 shadow mt-2 me-2 my-2">
<div class="notify text-capitalize">Total Admin</div>
<br/>
<h4 class="text-light">1 </h4>
</div>
<!-- notify bar 8-->
<div class="notify_bar  bg-dark text-light p-3  rounded-3 shadow mt-2 me-2 my-2">
<div class="notify text-capitalize">Total Admin</div>
<br/>
<h4 class="text-light">1 </h4>
</div>
<!-- notify bar 8-->
<div class="notify_bar  bg-dark text-light p-3  rounded-3 shadow mt-2 me-2 my-2">
<div class="notify text-capitalize">Total Admin</div>
<br/>
<h4 class="text-light">1 </h4>
</div>

<!-- notify bar 8-->
<div class="notify_bar  bg-dark text-light p-3  rounded-3 shadow mt-2 me-2 my-2">
<div class="notify text-capitalize">Total Admin</div>
<br/>
<h4 class="text-light">1 </h4>
</div>
<!-- notify bar 8-->
<div class="notify_bar  bg-dark text-light p-3  rounded-3 shadow mt-2 me-2 my-2">
<div class="notify text-capitalize">Total Admin</div>
<br/>
<h4 class="text-light">1 </h4>
</div>
<!-- notify bar 8-->
<div class="notify_bar  bg-dark text-light p-3  rounded-3 shadow mt-2 me-2 my-2">
<div class="notify text-capitalize">Total Admin</div>
<br/>
<h4 class="text-light">1 </h4>
</div>


</div>
</div>
<br/>


<?php require_once "adminVerNav.php";?>
    <!-- vertical navigator -->
    
  
</div>

</div>
<!-- data area -->


</div>


<script src="adminPageNav.js"></script>


</body>
</html>
