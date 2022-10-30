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

    .errorLog{
        display:none;
    }

    input{
            color:white;
        }
        input[type=text],input[type=password],input[type=email],input[type=number],textarea  {
        color:white;

        }

        input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill:hover,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill:focus,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date]:-webkit-autofill:active{
          -webkit-box-shadow: 0 0 0 30px #343a40 inset !important;
          color:white;
    }

      @media  (min-width: 992px) {
        .form .subject_name{
            width:75%;
        }
    }


</style>
<title>Admin Add Subject</title>
</head>

<div class="container-fluid p-0 ">
<?php require_once "adminNav.php";?>
<div class="d-flex align-items-center justify-content-around flex-row-reverse ">
<div class="data-area w-100 text-capitalize" id="data-area">
    <br/>
    <br/>
<div class="d-flex justify-content-center align-items-center p-4">
    

</div>
<!-- here is the data area -->
<h4 class="text-capitalize">add new subject</h4>
<div class="questionAdd text-capitalize p-3">
dear admin, add the subject you want the users to take below, the subject would reflect when they want to take a CBT
</div>
<br/>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST" class="form">

<label for="addQuestion">Add Subject:</label>
<br/><br/>
<div class="errorLog rounded p-2 justify-content-center align-items-center text-center text-capitalize text-light" id="errorLog" style="background:tomato;"></div>
<br/>
<input type="text" name="subject" id="subject" placeholder="Enter Subject Name" class="form-control m-auto text-light subject_name w-75" />
<br/>
<br/>

<input type="submit" value="Add Subject + " class="btn btn-danger" name="submit"/>

<hr/>
<h5 class="text-capitalize">proceed to add test or question</h5>

<br/>

<button class="text-capitalize text-center btn btn-dark my-2"><a href="adminAddTest.php" class="text-decoration-none text-center text-light">proceed to add test &gt;&gt;</a></button>
<br/>
<button class="text-capitalize text-center btn btn-dark my-2"><a href="adminAddQuestion.php" class="text-decoration-none text-center text-light">proceed to add question &gt;&gt;</a></button>

</form>
</div>
<br/>
<?php require_once "adminVerNav.php";?>
    <!-- vertical navigator -->
    
  
</div>

</div>
<!-- data area -->


</div>
<?php

#validate the user inputs

#import the necessary modules
require_once "../errorLog.php";
require_once "../validateMethods.php";


#check if the submit button was clicked
if(isset($_POST["submit"]) AND $_SERVER["REQUEST_METHOD"]==serverMethod){
    $subjectAdded=mysqli_real_escape_string($conn,parse_inputs($_POST["subject"]));

    if(empty($subjectAdded)){
        echo '<script>
        
        swal.fire({
            text:"Abeg enter a valid subject name!",
            icon:"error",
            timer:5000,
            allowOutsideClick:false
        });

        </script>';
        enter_valid_subject_name();

        die();
    }

    #check if the subject exists already
    $subject_duplicate_query="SELECT * FROM users_subjects WHERE subject_name = '$subjectAdded'";
    $subject_duplicate_result=mysqli_query($conn,$subject_duplicate_query);

    if(!$subject_duplicate_result){
        echo '<script>
        
        swal.fire({
            text:"An error occured while processing, try again!",
            icon:"error",
            timer:5000,
            allowOutsideClick:false
        });

        </script>';

      

        die();
    }else{
        if(mysqli_num_rows($subject_duplicate_result) > 0){
            echo '<script>
        
            swal.fire({
                text:"Subject already exists, please enter a new subject",
                icon:"error",
                timer:5000,
                allowOutsideClick:false
            });
    
            </script>';
            subject_exist_error();
            die();
        }else{
            #add the subject to the database
            $date_time_added=date("d/m/y")." - ".date("h:i:s:a");
            $subject_add_query="INSERT INTO users_subjects (subject_name , date_added) VALUES ('$subjectAdded','$date_time_added')";
            $subject_add_result=mysqli_query($conn,$subject_add_query);

            

            if(!$subject_add_result){
                echo '<script>
        
                swal.fire({
                    text:"An error occured while adding the subject, try again!",
                    icon:"error",
                    timer:5000,
                    allowOutsideClick:false
                });
        
                </script>';

                unknown_error_msg();

                die();
            }else{
                echo '<script>
        
                swal.fire({
                    text:"'.$subjectAdded.' added successfully.",
                    icon:"success",
                    timer:5000,
                    allowOutsideClick:false
                });
        
                </script>';
                subject_added_success($subjectAdded);
            }
        }
    }
}
?>

</body>
<script src="adminPageNav.js"></script>
</html>

<!-- subject_exist_error() -->