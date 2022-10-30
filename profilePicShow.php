<?php
require "conn.php";

if(!empty($_SESSION["ID"])){
	#this means someone is logged in, get the person's id
    $ID=$_SESSION["ID"];
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
<!-- <link rel="stylesheet" href="style.css"> -->

<script src="bootstrap.js"></script>
<script src="jquery.slim.min.js"></script>
<script src="sweetAlert2.js"></script>
<link rel="stylesheet" type="text/css" href="msgConfig.css"/>
<noscript>This application requires javaScript to run</noscript>

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
<body>
<?php require_once "nav.php";?>
    <div class="container m-auto d-flex justify-items-center align-items-center flex-column">
    <br/> <br/><br/><br/>
    <h3 class="text-capitalize text-center">user profile picture</h3>
       <?php
        #get the profilePic id
        $profile_pic_id=mysqli_real_escape_string($conn,parse_inputs($_GET["pDir"]));
        $profile_dir="profilePic/".$profile_pic_id;

        #get the user id
        $profile_id=mysqli_real_escape_string($conn,parse_inputs($_GET["ID"]));
        
        
        ?>

       <img src="<?php echo $profile_dir;?>" height="300" width="300" class="rounded shadow d-flex align-items-center justify-content-center m-auto my-5"/>
       <br/>
       <br/>
    <button class="btn btn-primary my-3"><a href='<?php echo "viewUsersProfile.php?ID=$profile_id"?>' class="text-decoration-none text-center text-light text-capitalize my-3 p-2">&lt;&lt; go back</a></button>
    </div>
</body>
</html>     