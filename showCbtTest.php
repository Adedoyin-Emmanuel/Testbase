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
	header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">

    <script src="bootstrap.js"></script>
    <script src="jquery.slim.min.js"></script>
    <script src="sweetAlert2.js"></script>
    <link rel="stylesheet" href="msgConfig.css"/>
    <title>Take CBT</title>
    <noscript>This application requires javaScript to run</noscript>

<style>
    

  ::-webkit-scrollbar{
    width:10px;
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
    background:#121212;
   }

</style>
</head>
<body class="text-light">
        
<?php require_once "nav.php";?>
<div class="container m-auto">
<div class="d-flex justify-content-center align-items-center p-4">
        <?php
         #$user_online_status=false;
         if($row["status"] == 1){
             echo ' <div class="rounded-circle status_online" ></div>';
             echo '<img src="profilePic/'.$user_info_row["profile_picture"].'"'.'height="50" width="50" class="rounded-circle alt="profile_pic" "';
         }else{
            echo ' <div class="rounded-circle status_offline" ></div>';
            echo '<img src="profilePic/'.$user_info_row["profile_picture"].'"'.'height="50" width="50" class="rounded-circle alt="profile_pic" "';
         }
        ?>
    <br/>
    <h4 class="text-capitalize text-center p-3" >welcome <?php echo $row["user_name"]?></h4>
</div>

<br/>

<h5 class="text-capitalize m-auto text-center">
    <?php echo  "Dear ". $user_info_row["user_name"] ?> please select a test type to take CBT
</h5>
<br/>
<?php

$subject_test_type=mysqli_real_escape_string($conn,parse_inputs($_GET["sub_ID"]));

#get the test type from the database based on the subject test type

$get_test_query="SELECT * FROM users_test WHERE subject_ID='$subject_test_type'";
    #check if the connection went well

    if(!$conn){
        echo '<script>
            swal.fire({
                text:"An error occured, connection was terminiated",
                icon:"error",
                title:"Fatal Error"

            });
            </script>';
        die();
    }

$get_test_result=mysqli_query($conn,$get_test_query);

    #check if the query went well
    if(!$get_test_result){
        echo '<script>
        swal.fire({
            text:"An error occured, while getting result from database",
            icon:"error",
            

        });
        </script>';
        die();
    }else{
        if(mysqli_num_rows($get_test_result) > 0){
           while($test_row=mysqli_fetch_assoc($get_test_result)){
            $data= '
            
            <a href="CBT.php?test_ID='.$test_row["ID"].'& sub_ID='.$test_row["subject_ID"].'"class="text-decoration-none subjects">
            <h6 class="text-capitalize text-center subjects">
            
            '.$test_row["test_name"].'
            
            </h6>
            </a>
            
            
            ';

            echo $data;
            }
        }else{

            $get_subject_query="SELECT * FROM users_subjects  WHERE ID='$subject_test_type' ";
            $get_subject_result=mysqli_query($conn,$get_subject_query);
            
            if(!$get_subject_result){
                echo '<script>
                swal.fire({
                    title:"Fatal Error",
                    text:"A fatal error occured, please contact the administrator to resolve this issue",
                    icon:"error"
                    
    
                });
                </script>';
                die("<h4 class='text-capitalize text-danger text-center'>A fatal error occured please contact admin to resolve this error</h4>");
            }
           
            
            $subject_row=mysqli_fetch_assoc($get_subject_result);
            
            echo '<script>
            swal.fire({
                text:"There is no test available for '.$subject_row["subject_name"].'",
                icon:"error",
                

            });
            </script>';
        echo ('<div class="d-flex align-items-center justify-content-around m-auto p-3">
       
       <button class="text-capitalize text-center btn btn-primary"><a href="takeCbt.php" class="text-decoration-none text-light text-capitalize">restart CBT</a></button>
       <button class="text-capitalize text-center btn btn-danger"><a href="contactAdmin.php" class="text-decoration-none text-light text-capitalize">contact admin</a></button>
       </div>');
        die("<h4 class='text-capitalize text-danger text-center'>There is no test avaliable for ".$subject_row["subject_name"]."</h4>");
        }
    }



?>

</div>
    
</body>
</html>