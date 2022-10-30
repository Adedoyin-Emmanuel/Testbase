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

<link rel="stylesheet" type="text/css" href="../msgConfig.css"/>

<style>

body{
    background:#121212;
    color:white;
}


  ::-webkit-scrollbar{
    width:5px;
    height:5px;
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



</style>
<title>View User Profile</title>
</head>
<body>
<?php require_once "adminNav.php";?>
<div class="container-fluid m-auto d-flex align-items-center justify-items-center pt-5 flex-column ">

<?php

require_once "../errorLog.php";
require_once "../validateMethods.php";

$user_profile_id=mysqli_real_escape_string($conn,(parse_inputs(htmlspecialchars_decode($_GET["ID"]))));

if(!$conn){die("Error occured with the connection".mysqli_error($conn));}

#query to get information with the user id
$user_profile_query="SELECT * FROM users_info WHERE U_ID ='$user_profile_id'";
$user_profile_result=mysqli_query($conn,$user_profile_query);
$user_default_status="offline";
#query all the users table to get some specific information
$all_user_query="SELECT * FROM users WHERE ID = '$user_profile_id'";
$all_user_result=mysqli_query($conn,$all_user_query);
$all_user_row="";
$date_joined="";
if(!$all_user_result){
    die("an error occured while trying to get the all users table data");
}
    if(mysqli_num_rows($all_user_result)>0){
        $all_user_row=mysqli_fetch_assoc($all_user_result);
        
        $date_joined=$all_user_row["date_joined"];


    }else{
        die("could not get the user table".mysqli_error($conn));
    }




if(!$user_profile_result){
    die("Error occured while getting information about the user from the database".mysqli_error($conn));
}else{
   if(mysqli_num_rows($user_profile_result) > 0){
       while($user_profile_row=mysqli_fetch_assoc($user_profile_result)){
        ($user_profile_row["status"] == 1) ? $user_default_status="online" : $user_default_status="offline";
        echo '<script>
        
        $(document).ready(()=>{

            $("#viewMore").click(()=>{
                $("#viewMorePanel").removeClass("d-none");
                $("#viewMorepanel").addClass("d-block");
            });
            

        });
        </script>'; 
        $profile_information='
        <div class="profile_information d-flex m-auto shadow rounded p-5 flex-column align-items-center justify-items-center bg-dark my-4">
            
            <h4 class="text-capitalize text-center p-3   w-100">'.$user_profile_row["user_name"]."'s".' profile information </h4>
        
        <hr/>
        <div class="profile_picture">
            <a href="adminProfilePicShow.php?pDir='.$user_profile_row["profile_picture"].'&ID='.$user_profile_id.'"><img src="../profilePic/'.$user_profile_row["profile_picture"].'" class="rounded" width="200" height="120"></a>
        </div>
        <br/>
        <div class="profile_title ">
            <p class="text-capitalize"><b>user-name</b>: '.$user_profile_row["user_name"].'</p>
            <p class="text-capitalize"><b>email</b>: '.$user_profile_row["email"].'</p>
            <p class="text-capitalize"><b>birthday</b>: '.$user_profile_row["birthday"].'</p>
            <p class="text-capitalize"><b>sex</b>: '.$user_profile_row["sex"].'</p>
            <p class="text-capitalize"><b>home-address</b>: '.$user_profile_row["home_address"].'</h5>
            
            <h5 class="text-capitalize text-center ">profile description</h5>
            
            <div class="text-capitalize ">'.$user_profile_row["comment"].'</div>
        <br/>
            <h5 class="text-capitalize text-left">actions:</h5>

            <br/>
            <button class="btn btn-danger text-capitalize"><a class="text-capitalize text-decoration-none text-light" href="adminMessageUser.php?receiver_id='.$user_profile_row["U_ID"].'">message user</a></button>

            <button class="btn btn-primary text-capitalize" id="viewMore">
                view more
            </button>
            <br/><br/>
            <div class="text-capitalize d-none view-more" id="viewMorePanel">
            <p class="text-capitalize"><b>Date-joined</b>: '.$date_joined.'</p>
            
            <p class="text-capitalize"><b>Phone-number</b>: '.$user_profile_row["phone_number"].'</p>

            
            <p class="text-capitalize"><b>profile-status</b>: '.$user_default_status.'</p>

           
            
            </div>
            <br/>
            <br/>
           <button class="btn btn-secondary"> <a href="adminManageUsers.php" class="text-capitalize text-decoration-none text-light">&lt;&lt;  go back</a></button>

        </div>
        </div>
          <br/>
          <br/>
          
          ';
        echo $profile_information;
       }
   }
}


?>
 </div>
</body>
</html>
