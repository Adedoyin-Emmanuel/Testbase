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

<title>Profile Picture</title>
</head>
<body >
<?php require_once "adminNav.php";?>
    <div class="container m-auto d-flex justify-items-center align-items-center flex-column ">
    <br/> <br/><br/><br/>
    <h3 class="text-capitalize text-center py-3">user profile picture</h3>
       <?php
        #get the profilePic id
        $profile_pic_id=mysqli_real_escape_string($conn,parse_inputs($_GET["pDir"]));
        $profile_dir="../profilePic/".$profile_pic_id;
        $user_id=mysqli_real_escape_string($conn,parse_inputs($_GET["ID"]));
        
        ?>

       <img src="<?php echo $profile_dir;?>" height="300" width="300" class="rounded shadow d-flex align-items-center justify-content-center m-auto py-5"/>
       <br/>
       <br/>
    <button class="btn btn-danger"><a  href='<?php echo "adminViewUsersProfile.php?ID=$user_id"?>' class="text-decoration-none text-center text-light text-capitalize">&lt;&lt; go back</a></button>
    </div>
</body>
</html>