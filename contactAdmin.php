<?php

require_once "conn.php";
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="bootstrap.css">

<script src="bootstrap.js"></script>
<script src="jquery.js"></script>
<script src="sweetAlert2.js"></script>
<link rel="stylesheet" href="bootstrap.css"/>
<link rel="stylesheet" href="msgConfig.css">
<style>



.errorLog{
    font-size:16px;
    display:none;
            
}

body{
    background:#121212;
    color:white;
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

</style>
<title>Contact Admin</title>
</head>
<body>
<?php require_once "nav.php";?>
<?php


?>

<div class="container-fluid m-auto d-flex align-items-center justify-items-around pt-5 flex-column ">

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
    <h3 class="text-capitalize text-center p-3" >welcome <?php echo $row["user_name"]?></h3>
</div>


<!-- message div -->

<div class="d-flex justify-items-around align-items-center flex-column">
    <form action="" method="POST" class="form p-5 m-auto shadow rounded-3 bg-dark text-light" >


    <h4 class="text-capitalize text-left ">drop a message for the admin</h4>

    <br/>
    <div class="errorLog rounded p-2 justify-content-center align-items-center text-center text-light" id="errorLog"  style="background:tomato;"></div>

    <br/>
    <label for="problems" class="text-capitalize p-2">Enter your username</label>
    <input type="text" name="user_name" id="u_name" class="form-control" placeholder="Enter your username" autofocus="true" required value="<?php echo $user_info_row["user_name"]?>">
    <br/>
    <label for="problems" class="text-capitalize p-2">Describe Your Problems Here</label>
    <textarea name="user_text" id="user_complain" class="form-control"    placeholder="Describe your problem" required rows="5">

    </textarea>
    <br/>

    <button type="submit" class="form-control btn btn-danger text-light "name="submit_problems" >Submit...</button>
    
</form>
</div>

<br/>
</div>


<?php

#import the necessary modules
require "errorLog.php";
require "validateMethods.php";




#check if the user submitted the problem form
if(isset($_POST["submit_problems"]) AND $_SERVER["REQUEST_METHOD"] == serverMethod){
    #get the username and validate
    $user_name=mysqli_real_escape_string($conn,parse_inputs($_POST["user_name"]));
    $user_problems=mysqli_real_escape_string($conn,parse_inputs($_POST["user_text"]));

    #check if the form elements are empty
    if(empty($user_name) OR empty($user_problems)){
        echo '<script>
            swal.fire({
                title:"Error",
                toast:true,
                position:"top-right",
                text:"Username or problem description can`t be empty",
                icon:"error"

            });
        </script>';
        username_or_description_empty();
       
    }else{
        #if the inputs are legit, validate again

        $check_username_query="SELECT * FROM users_info WHERE U_ID= '$ID'";
        $check_username_result=mysqli_query($conn,$check_username_query);

        if(!$conn){
            echo '<script>
            swal.fire({
                title:"Error",
                text:"A fatal error occured, could not connect to server.....",
                icon:"error"

            });
            </script>';
            die();
        }


        if(!$check_username_result){
            echo '<script>
            swal.fire({
                title:"Error",
                text:"An unknown error occured, please try again later",
                icon:"error"

            });
            </script>';
            unknown_error_msg();
            die();
        }


        if(mysqli_num_rows($check_username_result) > 0){

            #check if the user_name are the same

            $username_row=mysqli_fetch_array($check_username_result);

            if($user_name  == $username_row["user_name"]){
                #the username is legit
                $time_sent=date("d/m/y")." - ".date("h:i:s:a");
                $send_problems_query="INSERT INTO admin_msgs (User_ID,message,date_added) VALUES ('$ID','$user_problems','$time_sent')";


                $send_problems_result=mysqli_query($conn,$send_problems_query);

                if(!$send_problems_result){
                   echo '<script>
                    swal.fire({
                        text:"An error occured while processing the request",
                        icon:"warning"
        
                    });
                    </script>';
                    echo("<h4 class='text-capitalize text-center text-danger'>An error occured while processing the result</h4>");
                    die("An error occured while sending the messages".mysqli_error($conn));
                }else{
                    echo '<script>
                    swal.fire({
                        title:"Message Sent",
                        text:"Your message has been sent successfully, admin would ressolve your issue | problem and  get back to you ",
                        icon:"success",
                        showCancelButton:true,
                        showConfirmButton:true,
                        confirmButtonText:"Proceed To Dashboard",
                        confirmButtonColor:"dodgerblue",
                        cancelButtonColor:"tomato"

        
                    }).then((willProceed)=>{
                        if(willProceed.isConfirmed){
                            location.href="index.php";
                        }
                    });
                    </script>';
                    
                    msg_sent_success();


                }


            }else{
                echo '<script>
                swal.fire({
                    title:"Error",
                    text:"Invalid username, please enter the username you used to signup | login",
                    icon:"error"
    
                });
                </script>';
                unknown_error_msg();
                die();
                
            }
        }else{
            echo '<script>
            swal.fire({
                title:"Error",
                text:"An unknown error occured, the username you entered does not exist",
                icon:"error"

            });
            </script>';
            user_not_exist();
            die();

        }

    
    }



    

    




}


?>
</body>
</html>
