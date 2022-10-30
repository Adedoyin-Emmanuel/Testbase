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

dear Admin <?php echo $admin_info_row["user_name"]?>, below are some users who have messaged you concerning a problem they encountered on their account or while trying to take the examimation, view the messages and get back to them, if there are more than one notification from a user, please take your time to read them before deleting them.
</section>

<br/>
<!-- notify bar 2-->
<?php
$get_user_complain="SELECT * FROM admin_msgs";
$get_user_complain_result=mysqli_query($conn,$get_user_complain);
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
    $users_complain=mysqli_num_rows($get_user_complain_result);
}

$users_complain_row=mysqli_fetch_array($get_user_complain_result);



?>


<div>
    
</div>


<h4 class="text-capitalize text-center">all users messages</h4>


<div class="message_area d-flex justify-content-between align-items-start p-3 mt-3 flex-row flex-wrap">
    
<br/>






<?php

$get_users_messages="SELECT * FROM admin_msgs";
$get_users_result=mysqli_query($conn,$get_users_messages);

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
    if(mysqli_num_rows($get_users_result) > 0){
        while($users_data_row=mysqli_fetch_array($get_users_result)){

            $users_id=$users_data_row["User_ID"];
            #get the user information with the id
            $user_info_query="SELECT * FROM users_info WHERE U_ID ='$users_id'";
            $user_info_result=mysqli_query($conn,$user_info_query);

            if(!$user_info_result){
                echo '<script>
                    swal.fire({
                        title:"Error",
                        text:"couldn`t retrive some data from the database",
                        icon:"error"

                    });

                    </script>';
                die("error occured".mysqli_error($conn));
            }
            $user_info_row=mysqli_fetch_array($user_info_result);
            $user_status_profile="offline";
            if($user_info_row["status"]==1){
                $user_status_profile='<div class="active div-round bg-success p-2" title="online"></div>';
            }else{
                $user_status_profile='<div class="active div-round bg-danger p-2" title="offline"></div>';
            }
            
            $all_users_msgs='
            
      
                <a href="adminShowUserComplains.php?u_id='.$users_id.'" class="text-capitalize text-decoration-none text-light w-100 d-block">
                <div class="d-flex flex-row flex-wrap flex-wrap m-auto justify-content-start align-items-center bg-dark mt-3 p-3 rounded-3 shadow-lg">
                 '.$user_status_profile.'
                 <br/>
                <h5 class="text-capitalize mt-4">'.$user_info_row["user_name"].'</h5>
                <img src="../profilePic/'.$user_info_row["profile_picture"].'" height="50" width="50" class="img d-block"/>
                <br/>
               
                </div>
                </a>


                <br/>

                
            
            ';

            echo $all_users_msgs;
        }
    }else{
        echo '<script>
            swal.fire({
                title:"Error",
                text:"Server returned 0 results",
                icon:"warning"

            });

        </script>';
   
    echo("<h5 class='text-capitalize text-center m-auto text-danger'>server returned 0 result, come back later</h5>");
    echo "<br/>";
    echo "<br/>";
    die("<button class='text-capitalize text-center btn btn-danger m-auto'><a class='text-capitalize text-decoration-none text-light' href='index.php'>back to dashboard</a></button>");
    }
}


?>
</div>
<br/>
<br/>
<br/>



<!-- buttons for navigation -->


<div class="d-flex align-items-center justify-content-end flex-row-reverse">

<!-- 
<button class="btn btn-success text-center text-capitalize m-4"> <a href="adminChangeProfile.php" class="text-capitalize text-light text-center text-decoration-none"> change your profile
&gt;&gt; </a></button>
 -->

  <button class="btn btn-danger text-capitalize m-4"><a href="index.php" class="text-decoration-none text-capitalize text-light"> &lt;&lt; back to dashboard </a></button>
</div>
</div>

<br/>

</body>
<script src="adminPageNav.js"></script>
</html>