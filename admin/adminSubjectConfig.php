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


<link rel="stylesheet" href="../msgConfig.css">


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

<div class="container-fluid p-0 ">
<?php require_once "adminNav.php";?>
<div class="d-flex align-items-center justify-content-around flex-column m-auto ">
<div class="data-area w-100 text-capitalize" id="data-area">
<div class="d-flex justify-content-center align-items-center p-4">
    
   <?php
         #$user_online_status=false;
       echo '<img src="../profilePic/'.$admin_info_row["profile_picture"].'"'.'height="50" width="50" class="rounded-circle alt="profile_pic" "';
     
        ?>
        <br/>
    <h2 class="text-capitalize text-center p-3" >welcome <?php echo $row["user_name"]?></h2>
</div>
<!-- here is the data area -->
<h4 class="text-captitalize">Delete Subject/Test </h4>

<section class="section removeable">
    here, changes you make would reflect immediately on the users's profile, actions include deleting test types and subject 
</section>

<br/><br/>


<div class="text-capitalize d-flex justify-content-center align-items-center">

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">


<div class="form-group">
<label for="action_type" class="text-capitalize my-2">select action type</label>

  <select class="form-control bg-dark text-light" id="action" name="action_type">
    <option class="text-capitalize text-center " value="0">---SELECT---</option>
    <option class="text-capitalize text-center " value="1">Delete Subject</option>
    <option class="text-capitalize text-center " value="2">Delete Question</option>
    <option class="text-capitalize text-center " value="3">Delete Test</option>
  </select>
</div>

<br/>

<button type="submit" class="btn btn-danger m-auto" name="action_proceed">Proceed...</button>


</div>
<br/>
<br/>


</div>
<br/>



<?php



#check the type of action the admin wants to take

if(isset($_POST["action_proceed"]) AND $_SERVER["REQUEST_METHOD"] == serverMethod){
    #check the action from the select element
    $action_type=mysqli_real_escape_string($conn,parse_inputs($_POST["action_type"]));
    $action='';
    $all_result_row='';
    $template='';
    #check if the select element is empty
    if(empty($action_type)){
        echo '<script>
        swal.fire({
            text:"Abeg select a legit action",
            icon:"warning"

        });
        </script>';
        die();
    }
    # 1=> delete subject 2=> delete question 3=> delete test
    switch ($action_type) {
        case '0':
            echo '<script>
            swal.fire({
                text:"Abeg select a legit action",
                icon:"warning"

            });
            </script>';
            die();
            break;

        case '1':
            # code...
            $action=1;
            $template='
            
            
            <div class="result_data bg-dark text-light  rounded-3 shadow-lg d-flex justify-content-center align-items-center text-light w-100">        
            <table class="table table-dark table-responsive table-strip text-capitalize  text-light text-center m-auto p-5">
            <thead class="text-light">
            <tr>
                <th>subject name</th>
                <th>date added</th>
                <th>action</th>
            </tr>
            </thead>
            <tbody>
            ';
        
            break;

        case '2':
            # code...
            $action=2;
            break;

        case '3':
            # code...
            $action=3;

            break;
    
        default:
            # code...
            echo '<script>
            swal.fire({
                text:"Abeg select a legit action",
                icon:"warning"

            });
            </script>';
            break;
    }

   #1=> delete subject 2=> delete question 3=> delete test
    if($action == 1){
        #print a table to show all subjects
        #get all the subject name
        echo $template;
        $get_all_subject_query="SELECT * FROM users_subjects";
        $get_all_subject_result=mysqli_query($conn,$get_all_subject_query);
        

        if(!$get_all_subject_result){
            echo '<script>
            swal.fire({
                text:"An error occured while getting subjects",
                icon:"error"

            });
            </script>';
            die();
        }
        if(mysqli_num_rows($get_all_subject_result) > 0){
            while($all_result_row=mysqli_fetch_array($get_all_subject_result)){
                $table='
                <input type="text" value="'.$all_result_row[0].'" name="sub_id" hidden />
                    <tr class="text-light">
                
                        <td>'.$all_result_row[1].'</td>
                        
                        <td>'.$all_result_row[2].'</td>
                        <td><button class="btn btn-danger text-capitalize text-center" name="delete_subject">Delete Subject</button></td>
                    </tr>
                   
               
                ';

                echo $table;
                
               
            }
        }else{
            echo '<script>
            swal.fire({
                text:"No subject record found",
                icon:"error"

            });
            </script>';
            die();
        }



        // echo '<script>
        
        // $(document).ready(() => {
        //     $(".result_data").html("'.$table.'");
        // })
        // </script>';
    };
}


    if(isset($_POST["delete_subject"]) AND $_SERVER["REQUEST_METHOD"] == serverMethod){
        #get the subject id for deletion
        $get_subject_id=mysqli_real_escape_string($conn,parse_inputs($_POST["sub_id"]));

        #get the subject name
        $get_subject_name="SELECT * FROM users_subjects WHERE ID = '$get_subject_id'";
        $get_subject_name_result=mysqli_query($conn,$get_subject_name);

        #check if there was an error
        if(!$get_subject_name){
            echo '<script>

            swal.fire({
                title:"Error",
                text:"An unknown error occured",
                icon:"error"
            });

            </script>';
            die("an error occured".mysqli_error($conn));
        }

        #prepare the query
        $delete_subject_query="DELETE FROM users_subjects WHERE ID= '$get_subject_id'";

        $delete_subject_result=mysqli_query($conn,$delete_subject_query);
        $subject_name_row=mysqli_fetch_array($get_subject_name_result);

        #check if the connection was successful
        if(!$delete_subject_result){
            echo '<script>

            swal.fire({
                title:"Error",
                text:"An error occured while deleting questions please try again",
                icon:"error"
            });

            </script>';
            die("an error occured".mysqli_error($conn));
        }else{
              echo '<script>

            swal.fire({
                title:"Subject Deleted",
                text:"'.$subject_name_row["subject_name"].' deleted successfully",
                icon:"success"
            });

            </script>';
        }



        
    }

?>
</tbody>
</table>
</div>
    <!-- vertical navigator -->
    
  
</div>

</div>
<!-- data area -->


</div>

</body>
<script src="adminPageNav.js"></script>
</html>