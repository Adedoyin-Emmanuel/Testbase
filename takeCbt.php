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
    <title>Take Cbt</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">

    <script src="bootstrap.js"></script>
    <script src="jquery.slim.min.js"></script>
    <script src="sweetAlert2.js"></script>

    <link rel="stylesheet" href="msgConfig.css"/>
<style>
body{
    background:#121212;
}

.dashboard{
    
    height:100%;
    background:#121212;
    position:absolute;
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
.status_online{
	width:10px;
	height:10px;
	outline:2px solid white;
	background:green;
	transform:translate(48px,-8px);

    
	
}


.status_offline{
	width:10px;
	height:10px;
	outline:2px solid white;
	background:grey;
	transform:translate(57px,-8px);
	
}


.subjects:hover{
    color:white;
}


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




</style>
</head>
<body class="text-light">
    
<?php require_once "nav.php";?>
<div class="container-fluid m-auto">
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
    <?php echo  "Dear ". $user_info_row["user_name"] ?>, please select a subject to take CBT
</h5>

<section class="text-capitalize"></section>

<br/>
<br/>

<div class="text-center d-flex flex-column align-items-center justify-items-center">
   
    <?php
    
    #get the total subject that were prepared by the admin
    $get_subject_query="SELECT * FROM users_subjects ORDER BY subject_name ASC";
    $get_subject_result=mysqli_query($conn,$get_subject_query);

    #check if the conneciton was successful
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

    #check if the query was successful
    if(!$get_subject_result){
        
        echo '<script>
        swal.fire({
            text:"An error occured, while getting result from database",
            icon:"error",
            

        });
        </script>';
        die();
    }else{
        if(mysqli_num_rows($get_subject_result) > 0){

            while($subject_row=mysqli_fetch_assoc($get_subject_result)){
                $data= '
                
                <a href="showCbtTest.php?sub_ID='.$subject_row["ID"].' "class="text-decoration-none subjects">
                <h6 class="text-capitalize text-center subjects">
                
                '.$subject_row["subject_name"].'
                
                </h6>
                </a>
                
                
                ';

                echo $data;
            }
           

        }else{
            
        
                echo '<script>
                swal.fire({
                    text:"There are no available subject for test",
                    icon:"error",
                    title:"No subject Abailable"
        
                });
                </script>';
            
        }
    }
    
    
    ?>
</div>
</div>
</body>
</html>
