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
    background: #121212;
   }

</style>
<title>Admin Actions</title>
</head>
<body class="text-light">
<div class="container-fluid p-0 ">
    <?php require_once "adminNav.php";?>
    <div class="d-flex align-items-center justify-content-around flex-row-reverse ">
<div class="data-area w-100 text-capitalize" id="data-area">
  <br/><br/>
<div class="d-flex justify-content-center align-items-center p-4">
    
  
</div>

<!-- page content -->
<h3 class="text-capitalize ">admin actions</h3>
    <div class="text-capitalize text-center my-3 p-3">
        <h5 class="text-capitalize text-center my-3">get started ⚡</h5>
        
        here, you can set CBT's, manage users, message users, and do a whole lot of things explore 🚀
        
        
    </div>
<div class=" text-capitalize d-flex flex-column">
<div class="form-group actions d-flex align-items-center justify-content-center ">
    

<form class="form " action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
<label for="selectAdminAction" class="my-2">Select Admin Action:</label>
  <select class="form-control text-capitalize text-center bg-dark text-light" id="adminAction" name="adminActions">
    <option value="0" class="text-capitalize text-center  options default" id="defaultBtn">--SELECT--</option>
    <option value="1" class="text-capitalize text-center  options setCBT" id="setCbt">Set CBT</option>
    <option value="2" class="text-capitalize text-center  options allAdmin" id="allAdmin">All Admin</option>
    <option value="3" class="text-capitalize text-center  options addAdmin" id="addAdmin">Add Admin</option>
    <option value="4" class="text-capitalize text-center  options messageUsers" id="msgUsers">Message Users</option>
  </select>
  <br/>
  <input class="btn btn-danger text-capitalize text-center" type="submit" value="Proceed" name="submit"/>
</form>
</div>
<br/>
<!-- set cbt -->
<div class="setCbt action d-none">
<h5 class="text-capitalize">set cbt</h5>
<button class="btn btn-dark text-capitalize m-2 my-2"><a href="adminAddSubject.php" class="text-decoration-none text-light">+ Add Subject </a></button>
<button class="btn btn-dark text-capitalize m-2 my-2"><a href="adminAddTest.php" class="text-decoration-none text-light">+ Add Test</a></button>
<button class="btn btn-dark text-capitalize m-2 my-2"><a href="adminAddQuestion.php" class="text-decoration-none text-light">+ Add Question</a></button>
<button class="btn btn-dark text-capitalize m-2 my-2"><a href="adminCbtSettings.php" class="text-decoration-none text-light">Configure CBT (+)</a></button>

</div>

<!-- all admins -->
<div class="allAdmins action d-none">
    <h5 class="text-capitalize">all admins</h5>
    <button class="btn btn-dark text-capitalize my-2"> all admin &gt;&gt;</button>
<button class="btn btn-dark text-light text-capitalize my-2"> all admin profile &gt;&gt;</button>
</div>

<!-- add admin -->

<div class="addAdmin action d-none">
    <h5 class="text-capitalize">add admin</h5>
    <button class="btn btn-danger text-capitalize my-2">+ Add admin </button>
<button class="btn btn-danger text-capitalize my-2">- remove admin</button>
</div>

<!-- message users -->

<div class="messageUsers action d-none">
    <h5 class="text-capitalize">message users</h5>
    <button class="btn btn-dark text-capitalize my-2">send bulk messages + </button>
    <button class="btn btn-dark text-capitalize my-2"><a class="text-decoration-none text-light" href="adminManageUsers.php">Manage users</a></button>
</div>


</div>


</div>
<br/>

<?php require_once "adminVerNav.php";?>
    <!-- vertical navigator -->
    
  
</div>

</div>
<!-- data area -->


</div>

<!-- script -->
<script>
    //using jquery, raw js is a pain in the ass
    //hide all the element when the page is loaded
    $(document).ready(()=>{
       // $(".action").hide();
    })
 
</script>

<?php

#check if the button was clicked
if(isset($_POST["submit"]) AND $_SERVER["REQUEST_METHOD"] == serverMethod){
    $user_select_opt=mysqli_real_escape_string($conn,parse_inputs($_POST["adminActions"]));

    #add a condition to check what type of action the admin wants to make
    # 0=> default 1=>set cbt 2=>all admin 3=>add admin 4=>message users
    switch ($user_select_opt) {
        case '0':
           
            echo '<script>
            swal.fire({
                text:"Abeg select a legit action",
                icon:"warning"

            });
            </script>';
            break;
        case '1':

        #display the set cbt div
        echo '<script>
            $(".setCbt").removeClass("d-none");

        </script>';
            break;
        case '2':
            #display the all admins div
        echo '<script>
        $(".allAdmins").removeClass("d-none");

        </script>';
           
            break;
        case '3':
             #display the add  admins div
        echo '<script>
        $(".addAdmin").removeClass("d-none");

        </script>';
       
            break;  
        case '4':
        echo '<script>
        $(".messageUsers").removeClass("d-none");

        </script>';
            
            break;
        default:
           
        echo '<script>
        swal.fire({
            text:"Please select a legit action",
            icon:"warning"

        });
        </script>';
            break;
    }
}


?>
</body>
<script src="adminPageNav.js"></script>
</html>