

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>

<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="bootstrap.css">
<script src="jquery.slim.min.js"></script>
<script src="bootstrap.js"></script>
<script src="sweetAlert2.js"></script>
<noscript>This application requires javaScript to run</noscript>
<link rel="stylesheet" href="msgConfig.css">

<style>
  

    @media  (min-width: 992px) {
        .form{
            width:50%;
        }
    }

</style>

<?php
require "conn.php";

if(empty($_SESSION["ID"])){
    #if the user is not logged in then navigate the user back
    #header("Location: login.php");
    echo '<script>

        location.href="login.php";

    </script>';
}

  $ID=$_SESSION["ID"];
  $query="SELECT * FROM users WHERE ID = $ID";
  $result=@mysqli_query($conn,$query);
  $row=@mysqli_fetch_array($result);


  #perform another query
  $user_info_query="SELECT * FROM users_info WHERE U_ID = '$ID'";
  $user_info_result=@mysqli_query($conn,$user_info_query);
  $user_info_row=@mysqli_fetch_array($user_info_result);


  if(!$user_info_result){
    echo '<script>

      swal.fire({
          title:"Update Profile",
          text:"Server returned 0 profile information, please update your profile".
          icon:"warning",
          allowOutsideClick:false,
          confirmButtonText:"Home",

      }).then((willProceed)=>{
          if(willProceed.isConfirmed){
              location.href="index.php";
          }
      });

    </script>';

    die();
  }

  #check if the user has updated their profile

  if($user_info_row["profile_updated"] ==  0){
       echo '<script>

      swal.fire({
          title:"Update Profile",
          text:"Server returned 0 profile information, please update your profile".
          icon:"warning",
          allowOutsideClick:false,
          confirmButtonText:"Updated Profile",
          cancelButtonText:"Home",

      }).then((willProceed)=>{
          if(willProceed.isConfirmed){
              location.href="changeProfile.php";
          }else{
            location.href="index.php";
          }
      });

    </script>';

    die();
  }


?>

<title><?php echo $row["user_name"]. " ". "Profile";?></title>


<style>

    ::-webkit-scrollbar{
    width:5px;
    background:#121212;
    height:5px;
  }

  ::-webkit-scrollbar-thumb{
    border-radius:20px;
    opacity:.7;
    background:dodgerblue;
    width:2px;
    height:2px;
  }

   ::-webkit-scrollbar-button{
    display:none;
   }

   ::-webkit-scrollbar-corner{
    display: none;
   }

   body{
    background:#121212;
   }

  </style>
</head>
<body class="text-light">

<div class="container-fluid p-0 m-auto text-capitalize text-light">
  <?php require_once "nav.php";?>
    <section class="text-capitalize p-4 m-auto">
    <div class="d-flex justify-content-start align-items-center p-4">
    <img src="<?php echo "profilePic/".$user_info_row["profile_picture"]?>" height="50" width="50" class="rounded-circle" alt="<?php echo $user_info_row["user_name"]. " " . "profile picture"?>"/>
    <h4 class="text-capitalize text-center p-3" >welcome <?php echo $row["user_name"]?></h4>
</div>
dear <?php echo $row["user_name"]?>, below are your profile and some login information we have encrypted your password for security reasons, the information you provided would be used in updating your profile description in the news feed. you can always change your profile information in the dashboard..
</section>

<br/>
      <div class="profile_information d-flex m-auto shadow rounded p-5 flex-column align-items-center justify-items-center bg-dark form">
            
            <h4 class="text-capitalize text-center p-3   w-100 bg-primary">profile information </h4>
        
        <hr/>
        <br/>
        <div class="profile_title ">
            <p class="text-capitalize"><b>user-name</b>: <?php echo $user_info_row["user_name"]?></p>
            <p class="text-capitalize"><b>email</b>: <?php echo $user_info_row["email"]?></p>
            <p class="text-capitalize"><b>birthday</b>: <?php echo $user_info_row["birthday"]?></p>
            <p class="text-capitalize"><b>sex</b>: <?php echo $user_info_row["sex"]?></p>
            <p class="text-capitalize"><b>home-address</b>: <?php echo $user_info_row["home_address"]?></h5>
            
            <h5 class="text-capitalize text-center ">profile description</h5>
            
            <div class="text-capitalize ">
              
              <?php  echo $user_info_row["comment"]?>
            </div>
            <br/>
            <h5 class="text-capitalize text-left">actions:</h5>

            <br/>
           
            <button class="btn btn-primary text-capitalize" id="viewMore">
                view more
            </button>
            <br/><br/>
            <div class="text-capitalize d-none view-more" id="viewMorePanel">

            <?php


              $date_joined=explode("-",$row["date_joined"]);

              $legit_date_joined=reset($date_joined);
              $legit_time_joined=end($date_joined);



            ?>


            <p class="text-capitalize"><b>Date-joined</b>: <?php echo $legit_date_joined?></p>

             <p class="text-capitalize"><b>Time-joined</b>: <?php echo $legit_time_joined?></p>
            
            
            <p class="text-capitalize"><b>Phone-number</b>: <?php echo $user_info_row["phone_number"]?></p>

            <?php

              $user_default_status="offline";

              ($user_info_row["status"] == 1) ? $user_default_status="online" : $user_default_status="offline";

                echo '<script>
                  
                      $(document).ready(()=>{

                          $("#viewMore").click(()=>{
                              $("#viewMorePanel").removeClass("d-none");
                              $("#viewMorepanel").addClass("d-block");
                          });
                          

                      });
                  </script>';

            ?>
            <p class="text-capitalize"><b>profile-status</b>: <?php echo $user_default_status?></p>

           
            
            </div>
            <br/>
            <br/>
           <button class="btn btn-danger"> <a href="findUsers.php" class="text-capitalize text-decoration-none text-light">&lt;&lt;  back</a></button>

        </div>
        </div>
          <br/>
          <br/>
              

<hr/><br/>
<br/>
<br/>



<!-- buttons for navigation -->


<div class="d-flex align-items-center justify-content-center flex-row-reverse m-auto">


<button class="btn btn-dark text-center text-capitalize m-4"> <a href="changeProfile.php" class="text-capitalize text-light text-center text-decoration-none"> change profile
 </a></button>


  <button class="btn btn-dark text-capitalize m-4"><a href="index.php" class="text-decoration-none text-capitalize text-light"> &lt;&lt; Home </a></button>
</div>
</div>

<br/>
<?php require_once "footer.php"; ?>
</body>
</html>


