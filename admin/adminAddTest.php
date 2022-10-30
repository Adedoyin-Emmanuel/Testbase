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
    input[type=text],input[type=password],input[type=email],input[type=number],textarea  {
      color:white;

    }
    input{
    color:white;
    }
    input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill:hover,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill:focus,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date]:-webkit-autofill:active{
          -webkit-box-shadow: 0 0 0 30px #212529 inset !important;
    }
    textarea{
    
      background:#121212;
    }
      
</style>
<title>Add Test Type</title>
</head>
<body class="text-light">

<div class="container-fluid p-0 ">
<?php require_once "adminNav.php";?>
<div class="d-flex align-items-center justify-content-around flex-row-reverse ">
<div class="data-area w-100 text-capitalize" id="data-area">
  <br/><br/>
<div class="d-flex justify-content-center align-items-center p-4">
    
 
</div>
<!-- here is the data area -->
<h4 class="text-capitalize">add test type</h4>
<div class="text-capitalize addTestType d-flex align-items-center flex-column justify-items-center">

<br/>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

<div class="errorLog rounded p-2 justify-content-center align-items-center text-center text-capitalize text-light" id="errorLog" style="background:tomato;"></div>
<br/>
<div class="form-group">
<label for="subjectName" class="text-capitalize">select subject name</label>
<select class="form-control text-light bg-dark" id="selectSubject" name="subjectName">

  <?php
   require_once "../errorLog.php";
   require_once "../validateMethods.php";
   $subject_query="SELECT * FROM users_subjects ORDER BY ID DESC";
   $subject_query_result=mysqli_query($conn,$subject_query);
   $subject_row=" ";

   if(!$conn){
    echo '<script>
        
    swal.fire({
        text:"An error occured connection was terminated, try again or contact admin! ",
        icon:"error",
        timer:5000,
        allowOutsideClick:false
    });

    </script>';
    die();
   }
   if(!$subject_query_result){
    echo '<script>
        
    swal.fire({
        text:"An error occured while getting subject from server, try again! ",
        icon:"error",
        timer:5000,
        allowOutsideClick:false
    });

    </script>';

    unknown_error_msg();
   }else{
       if(mysqli_num_rows($subject_query_result) > 0){

         while($subject_row=mysqli_fetch_assoc($subject_query_result)){
             echo '
             <option value="'.$subject_row["ID"].'" class="text-capitalize text-center">'.$subject_row["subject_name"].'</option>
             ';
         }

       }else{
           #the user or admin haven't entered any subject

           echo '<script>
        
                swal.fire({
                    text:"you have not any subject in the database, please add subject then proceed to add test type, try again!",
                    icon:"error",
                    confirmButtonText:"Add Subject",
                    allowOutsideClick:false
                }).then((willProceed)=>{
                    if(willProceed.isConfirmed){
                        location.href="adminAddSubject.php";
                    }
                });
        
                </script>';

                unknown_error_msg();
       }
   }
  
  ?>
     </select>
</div>

<br/>

<label for="totalQuestion"class="text-capitalize">enter total question</label>


<input type="number" name="totalQuestions" id="totalQuestion" placeholder="Enter total question" class="form-control text-light" required autocomplete="off"/>
<br/>
<label for="testType"class="text-capitalize">enter test type</label>


<input type="text" name="testType" id="testType" placeholder="Enter test type" class="form-control text-light" required autocomplete="off">
<br/>
<button class="text-capitalize btn btn-dark my-2 me-2"><a href="adminAddSubject.php" class="text-decoration-none text-center text-light">&lt;&lt; proceed to add subject <a/></button>
<input type="submit" value="Submit" class="btn btn-danger my-2 me-2 text-light" name="submit" >
<button class="text-capitalize btn btn-dark me-2 my-2"><a href="adminAddQuestion.php" class="text-decoration-none text-center text-light">proceed to set question &gt;&gt;<a/></button>
</form>

</div>
</div>
<br/>
<?php require_once "adminVerNav.php";?>
    <!-- vertical navigator -->
    
  
</div>

</div>
<!-- data area -->


</div>
<!-- validation -->

<?php


#validate the user input

#check if the admin clicked the submit button


if(isset($_POST["submit"]) AND $_SERVER["REQUEST_METHOD"] ==serverMethod){

    #check if the user inputs are empty
$subjectID=mysqli_real_escape_string($conn,parse_inputs($_POST["subjectName"]));
$totalQuestions=mysqli_real_escape_string($conn,parse_inputs($_POST["totalQuestions"]));
$testType=mysqli_real_escape_string($conn,parse_inputs($_POST["testType"]));


    if(!empty($subjectID) AND !empty($totalQuestions) AND !empty($testType)){

      #send inputs to the database
      $test_query="INSERT INTO users_test (subject_ID,total_questions,test_name) VALUES ('$subjectID','$totalQuestions','$testType')";
      $test_query_result=mysqli_query($conn,$test_query);

      if(!$test_query_result){
        echo '<script>
        
        swal.fire({
            text:"An error occured while storing test type! try again later ",
            icon:"error",
            allowOutsideClick:false
        });
    
        </script>';
        die();
      }else{
        echo '<script>
        
        swal.fire({
            text:"'.$testType.' Added Successfully",
            icon:"success",
            allowOutsideClick:false
        });
    
        </script>';
        subject_added_success($testType);
      }
    }else{
        echo '<script>
        

        swal.fire({
            text:"Abeg fill in the required input, all inputs are required",
            icon:"error",
            timer:5000,
            allowOutsideClick:false
        });
    
        </script>';
        die();
    }

}

?>
</body>
<script src="adminPageNav.js"></script>
</html>