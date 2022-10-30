<?php
require "../conn.php";

if(!empty($_SESSION["Admin_ID"])){
	#this means someone is logged in
	$ID=$_SESSION["Admin_ID"];
	$query="SELECT * FROM admin WHERE ID = '$ID'";
	$result=mysqli_query($conn,$query);
	$data_row=mysqli_fetch_array($result);


    
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

<style>
    
</style>
<title>Admin View Profile</title>
</head>
<body>
<div class="container-fluid p-0 m-auto text-capitalize text-light">
  <?php require_once "adminNav.php";?>
    <section class="text-capitalize p-4 m-auto">
       <div class="d-flex justify-content-start align-items-center p-4">
    <?php
         #$user_online_status=false;
         if($data_row["status"] == 1){
             
             echo '<img src="../profilePic/'.$admin_info_row["profile_picture"].'"'.'height="50" width="50" class="rounded-circle alt="profile_pic" "';
         }else{
           
            echo '<img src="../profilePic/'.$admin_info_row["profile_picture"].'"'.'height="50" width="50" class="rounded-circle alt="profile_pic" "';
         }
        ?>
        <br/><br/>
    <h4 class="text-capitalize text-center p-3" >welcome <?php echo $admin_info_row["user_name"]?></h4>
</div>

dear Admin <?php echo $admin_info_row["user_name"]?>, below are your profile and some login information we have encrypted your password for security reasons, the information you provided would be used in updating your profile description in the news feed. you can always change your profile information in the dashboard..
</section>

<br/> <div class="profile_information d-flex m-auto shadow rounded p-5 flex-column align-items-center justify-items-center bg-dark">
            
            <h4 class="text-capitalize text-center p-3   w-100 bg-danger ">profile information </h4>
        
        <hr/>
        <br/>
        <div class="profile_title ">
            <p class="text-capitalize"><b>user-name</b>: <?php echo $admin_info_row["user_name"]?></p>
            <p class="text-capitalize"><b>email</b>: <?php echo $admin_info_row["email"]?></p>
            <p class="text-capitalize"><b>birthday</b>: <?php echo $admin_info_row["birthday"]?></p>
            <p class="text-capitalize"><b>sex</b>: <?php echo $admin_info_row["sex"]?></p>
            <p class="text-capitalize"><b>home-address</b>: <?php echo $admin_info_row["home_address"]?></h5>
            
            <h5 class="text-capitalize text-center ">profile description</h5>
            
            <div class="text-capitalize ">
              <?php echo $admin_info_row["comment"]?>
            </div>
            <br/>
            <h5 class="text-capitalize text-left">actions:</h5>

            <br/>
           
            <button class="btn btn-primary text-capitalize" id="viewMore">
                view more
            </button>
            <br/><br/>

            <?php

            $date_joined=explode("-",$data_row["date_joined"]);
            $legit_date_joined=reset($date_joined);
            $legit_time_joined=end($date_joined);

            #get the admin's profile status
            $default_profile_status="offline";

            ($row["status"] == 1) ? $default_profile_status="online" : $default_profile_status="offline";


            echo '<script>
            
                $(document).ready(()=>{

                    $("#viewMore").click(()=>{
                        $("#viewMorePanel").removeClass("d-none");
                        $("#viewMorepanel").addClass("d-block");
                    });
                    

                });
            </script>';

            ?>
            <div class="text-capitalize d-none view-more" id="viewMorePanel">
            <p class="text-capitalize"><b>Date-joined</b>: <?php echo $legit_date_joined?></p>

            <p class="text-capitalize"><b>Time-joined</b>: <?php echo $legit_time_joined?></p>

            
            <p class="text-capitalize"><b>Phone-number</b>: <?php echo $admin_info_row["phone_number"]?></p>

            
            <p class="text-capitalize"><b>profile-status</b>: <?php echo $default_profile_status?></p>

           
            
            </div>
            <br/>
            <br/>
           <button class="btn btn-danger"> <a href="findUsers.php" class="text-capitalize text-decoration-none text-light">&lt;&lt;back</a></button>

        </div>
        </div>
          <br/>
          <br/>
              


<br/>
<br/>



<!-- buttons for navigation -->


<div class="d-flex align-items-center justify-content-end flex-row-reverse">


<button class="btn btn-dark text-center text-capitalize m-4"> <a href="adminChangeProfile.php" class="text-capitalize text-light text-center text-decoration-none"> change profile
&gt;&gt; </a></button>


  <button class="btn btn-dark text-capitalize m-4"><a href="index.php" class="text-decoration-none text-capitalize text-light"> &lt;&lt; dashboard </a></button>
</div>
</div>

<br/>
<?php require_once "../footer.php"?>
</body>
<script src="adminPageNav.js"></script>
</html>