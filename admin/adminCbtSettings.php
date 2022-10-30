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
    
    .action{
        animation:slide .1s linear 1;
    }



    @keyframes slide{
        from{
            transform:translateY(-20px);
            opacity:.5;
        }
        to{
            transform:translateY(10px);
            opacity:1;
        }
    }
</style>
<title>Admin CBT Settings</title>
</head>
<body>
<div class="container-fluid p-0 ">
<?php require_once "adminNav.php";?>
<div class="d-flex align-items-center justify-content-center flex-row-reverse ">
<div class="data-area w-100 text-capitalize" id="data-area">
    <br/><br/>
<div class="d-flex justify-content-center align-items-center p-4">
    
   <?php
         #$user_online_status=false;
        
            
            echo '<img src="../profilePic/'.$admin_info_row["profile_picture"].'"'.'height="50" width="50" class="rounded-circle alt="profile_pic" "';
         
        ?>
        <br/>
    <h2 class="text-capitalize text-center p-3" >welcome <?php echo $row["user_name"]?></h2>
</div>
<!-- here is the data area -->
<h4 class="text-captitalize ">configure CBT </h4>

<section class="section removeable">
    here, you can make changes to the questions you have set, you could also view all the questions for each subject and each test type, actions like edit, add and delete could also 
    be performed
</section>
<br/>
<button class="text-capitalize btn btn-primary removeable" id="showActions">get started</button>
<br/><br/>
<h4 class="text-capitalize  text-sm-center d-none removeable cbtSettings action text-sm-center" id="cbtSettings">CBT Settings</h4>
<br/>
<div class="text-capitalize d-flex flex-md-row flex-sm-column  align-items-center justify-content-evenly action d-none p-3 edit_actions removeable flex-wrap" id="edit_actions">

<br/><br/>
<button class="text-capitalize btn btn-dark removeable mt-3"><a href="adminEditPanel.php" class="text-capitalize text-decoration-none text-light">view Questions</a></button>

<button class="text-capitalize btn btn-dark removeable mt-3" disabled><a href="adminEditPanel.php" class="text-capitalize text-decoration-none text-light">Configure CBT</a></button>

<button class="text-capitalize btn btn-dark removeable mt-3" ><a href="adminSubjectConfig.php" class="text-capitalize text-decoration-none text-light">Delete Questions/Test/Subject</a></button>

</div>
</div>
<br/>
<?php require_once "adminVerNav.php";?>
    <!-- vertical navigator -->
    
  
</div>

</div>
<!-- data area -->


</div>

<script>

    //use jquery to check for button click
    $(document).ready(()=>{
        //check if the get started button is clicked
        $("#showActions").click(()=>{
            $(".cbtSettings").removeClass("d-none");
            $(".edit_actions").removeClass("d-none");
        })
    })
</script>
</body>
<script src="adminPageNav.js"></script>
</html>