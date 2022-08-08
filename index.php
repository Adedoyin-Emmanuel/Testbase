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

<script src="bootstrap.js"></script>
<script src="jquery.slim.min.js"></script>
<script src="sweetAlert2.js"></script>
<script src="userPageNav.js"></script>

<link rel="stylesheet" href="msgConfig.css">

<title>Dashboard</title>

<style>

  body{
    background: #121212;
    color:white;
  }

  ::-webkit-scrollbar{
    width:5px;
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

   .sidenav::-webkit-scrollbar{
    width:5px;
    height:5px;
    background:#121212;

  }

  .sidenav::-webkit-scrollbar-thumb{
    border-radius:20px;
    opacity:.7;
    background:dodgerblue;
    width:2px;
  }

   .sidenav::-webkit-scrollbar-button{
    display:none;
   }

   .sidenav::-webkit-scrollbar-corner{
    display: none;
   }



.dashboard{
    
    height:100%;
    background:#121212;
    position:absolute;
    left:0;
    top:;
    right:0;
    bottom:0;
    z-index: 1;

  
}
.menu-items{
    text-align:center;
    
}

.data-area{
    z-index: 1;
    float:right;
    position:static;
    text-align:center;

}
.status_online{
	width:15px;
	height:15px;
	outline:2px solid white;
	background:green;
	transform:translate(57px,-8px);

    
	
}


.status_offline{
	width:15px;
	height:15px;
	outline:2px solid white;
	background:grey;
	transform:translate(57px,-8px);
	
}




.d-btn{
  background:#121212;
  border-color:white;
  color:black;

}

</style>
</head>
<body class="text-light">
<div class="container-fluid p-0 text-light">

<?php require_once "nav.php";?>
<div class="d-flex align-items-center justify-content-around flex-row-reverse ">
<div class="data-area w-100 text-capitalize "id="data-area">
    <div class="d-flex justify-content-center align-items-center p-4">
        <?php
         #$user_online_status=false;
         if($row["status"] == 1){
            
             echo '<img src="profilePic/'.$user_info_row["profile_picture"].'"'.'height="50" width="50" class="rounded-circle alt="profile_pic" "';
         }else{
            
            echo '<img src="profilePic/'.$user_info_row["profile_picture"].'"'.'height="50" width="50" class="rounded-circle alt="profile_pic" "';
         }
        ?>
    <br/>
    <h2 class="text-capitalize text-center p-3" >welcome <?php echo $row["user_name"]?></h2>
</div>
  <?php
  #check if the user has updated his/her profile or not
  $user_update_profile_query="SELECT * FROM users_info WHERE U_ID = $ID";
  $user_update_profile_result=mysqli_query($conn,$user_update_profile_query);
  $user_update_profile_row=mysqli_fetch_assoc($user_update_profile_result);

  #check if the query was successful
  if(!$user_update_profile_result){
      echo "an unknown error occured";
  }else{
      if(mysqli_num_rows($user_update_profile_result) > 0){
        #the query was successful and there is a record in the dbase
        #check if the user has updated the profile
        if($user_update_profile_row["profile_updated"] == 1){
              echo "Welcome Back ". $row["user_name"].", you updated your profile details on... ". $user_update_profile_row["time_updated"].", you can always change your profile details";
              echo '
                <br/><br/>
               <!-- <button class="btn btn-primary text-center text-capitalize"> <a href="changeProfile.php" class="text-decoration-none text-center text-light">change profile details &gt;&gt;</a> </button>
                -->';
          $html_template='

            <section class="m-auto">


            <h5 class="text-capitalize text-sm-center text-md-center p-2 text-bold">are you new here?</h5>

            <p class="">
            On this platform, you can <a href="findUsers.php" class="text-capitalize text-decoration-none text-primary" >find other users</a>, relate, <a class="text-capitalize text-decoration-none text-danger" href="showUsers.php">chat</a> and get to know each other better, to know know more, you can also take a <i>tour</i> to get familiar with <strong class="text-primary">Test-Base</strong>
            </p>

            <button class="btn btn-primary text-capitalize text-light d-sm-block d-md-none m-auto" id="take_a_tour">Take a tour</button> </section>
            <br/>
            <button class="btn btn-secondary text-capitalize text-light" id="test_base d-sm-none d-md-block my-2 p-2">About Test_Base</button>

          ';

          echo $html_template;
        }else{
            echo $row["user_name"].", you have not updated your profile please click the button below to update your profile";
            echo '
            <br/><br/>
            <button class="btn btn-primary text-center text-capitalize"> <a href="updateProfile.php" class="text-decoration-none text-center text-light">update profile &gt;&gt;</a> </button>
            ';
        }
      }else{
        echo $row["user_name"].", you have not updated your profile please click the button below to update your profile";
            echo '
            <br/><br/>
            <button class="btn btn-primary text-center text-capitalize"> <a href="updateProfile.php" class="text-decoration-none text-center text-light">update profile &gt;&gt;</a> </button>
            ';
      }
  }
  



?>
</div>
<br/>
    <!-- vertical navigator also known as dashboard -->
</div>

</div>
<!-- data area -->

</div>


<script>
  

  $(document).ready(()=>{
      $("#take_a_tour").click(()=>{
          openNav();
      });
  });

</script>

<noscript>This application requires javaScript to run</noscript>
</body>
</html>
