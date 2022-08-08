<?php
require "conn.php";


    #check if the admin is logged in
    if(!empty($_SESSION["admin-ID"])){
        
	#this means someone is logged in
	$ID=$_SESSION["admin-ID"];
	$query="SELECT * FROM users WHERE ID = $ID";
	$result=mysqli_query($conn,$query);
	$row=mysqli_fetch_assoc($result);

        //echo "admin is logged in";
        #header("Location: adminDashboard.php");
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
<link rel="stylesheet" href="style.css">

<script src="bootstrap.js"></script>
<script src="jquery.slim.min.js"></script>
<script src="sweetAlert2.js"></script>



<title class="text-capitalize"> <?php echo $row["user_name"]?> Dashboard</title>

<style>
body{
    background:ghostwhite;
}

.dashboard{
    
    height:100%;
    background:lightblue;
    position:fixed;
    left:0;
    top:40px;
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

.nav{
    background:lightblue;
    
}



</style>
</head>
<body>
<div class="container-fluid p-0 ">

<div class="hor-nav">
<ul class="nav nav-tabs d-flex align-items-center justify-content-around">
  <li class="nav-item">
    <a class="nav-link active text-capitalize text-dark" id="home" href="#">dashboard</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-capitalize text-dark" id="takeCbt" href="#">take cbt</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-capitalize text-dark" id="aboutUs" href="#">about us</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-capitalize text-dark log-out" id="" href="#">log out</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-capitalize text-dark" id="history" href="#">Exam History</a>
  </li>
</ul>
</div>
<div class="d-flex align-items-center justify-content-around flex-row-reverse ">
<div class="data-area w-50 text-capitalize">
    <h2 class="text-capitalize text-center p-3" >welcome <?php echo $row["user_name"]?></h2>
   dear <?php echo $row["user_name"].","?> please complete your profile by updating your data, update your data by clicking the update profile in the dashboard.
</div>
<br/>
    <!-- vertical navigator -->
<div class="dashboard text-left p-3 w-25 h-100">

    <h4 class="text-capitalize text-center bg-success text-light p-2 "><?php echo $row["user_name"]?> dash-board</h4>
    <br/>
    <h4 class="text-capitalize text-center">welcome <?php echo $row["user_name"]?></h4>
<div class="menu-items row d-flex  flex-column justify-content-center align-items-center m-3">
    
    <br/>
    <button class="update-profile btn btn-info text-capitalize text-light">Update-Profile</button>
    <br/>
    <button class="set-cbt btn btn-primary text-capitalize">Set-CBT</button>
    <br/>
    <button class="log-out btn btn-warning text-capitalize text-light">log-out</button>
    <br/>
    <button class="cbt-history btn btn-success text-capitalize">CBT-history</button>
    <br/>
    <button class="view-profile btn btn-secondary text-capitalize ">View Profile</button>
    <br/>
    <button class="view-all-users btn btn-dark text-capitalize ">View All Users</button>

<br/>
</div>
</div>
</div>

</div>
<!-- data area -->


</div>


<script>


$(document).ready(()=>{
    $(".log-out").click(()=>{
        swal.fire({
            title:"Admin Log-Out",
            text:"Dear Admin, Are you sure you want to log out of this account..",
            icon:"info",
            timer:5000,
            showCancelButton:true,
            showConfirmButton:true,
            showCloseButton:true,
            allowOutsideClick:false,
            timerProgressBar:true,
            cancelButtonColor:"tomato"

        }).then((willProceed)=>{
            if(willProceed.isConfirmed){
                location.href="logOut.php";
            }else{
                return;
            }
        })
    });

    $(".update-profile").click(()=>{
        //perform operation
        location.href="updateProfile.php";
    });


    $(".set-cbt").click(()=>{
        //perform operation
    });

    $(".cbt-history").click(()=>{
        //perform operation
    });

    $(".view-all-users").click(()=>{
        //perform operation
        location.href="allUsers.php";

    });
    
});



</script>


</body>
</html>
