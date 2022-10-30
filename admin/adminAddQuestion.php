<?php
require_once "../conn.php";

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
    input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill:hover,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill:focus,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date]:-webkit-autofill:active{
          -webkit-box-shadow: 0 0 0 30px #212529 inset !important;
    }
    textarea{
    
      background:#121212;
    }
      
</style>

<title>Admin Add Question</title>
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
<h4 class="text-capitalize">add question +</h4>
<br/>
<div class="questionAdd  p-5 shadow-lg bg-dark rounded-3 text-light flex-column">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="d-flex flex-column justify-content-center align-items-start">
<div class="errorLog rounded p-2 justify-content-center align-items-center text-center m-auto w-100 text-capitalize text-light" id="errorLog" style="background:tomato;"></div>
<br/>
<h4 class="text-capitalize text-center text-light m-auto">select test name</h4>
<label for="testName" class="text-capitalize p-2">select test name</label>
<select class="form-control bg-dark text-light" id="testName" name="testName">
<?php
   require_once "../errorLog.php";
   require_once "../validateMethods.php";
   $test_query="SELECT * FROM users_test ORDER BY ID DESC ";
   $test_query_result=mysqli_query($conn,$test_query);
   $test_row=" ";

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
   if(!$test_query_result){
    echo '<script>
        
    swal.fire({
        text:"An error occured while getting result from server, try again! ",
        icon:"error",
        timer:5000,
        allowOutsideClick:false
    });

    </script>';

    unknown_error_msg();
   }else{
       if(mysqli_num_rows($test_query_result) > 0){

         while($test_row=mysqli_fetch_assoc($test_query_result)){
             echo '
             <option value="'.$test_row["ID"].'" class="text-capitalize text-center">'.$test_row["test_name"].'</option>
             ';
         }

       }else{
           #the user or admin haven't entered any subject

           echo '<script>
        
                swal.fire({
                    text:"you have not any test in the database, please add subject then proceed to add test type, try again!",
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

     <br/>
     <label for="question" class="text-capitalize p-2">enter your question</label>
     <textarea name="question" id="question" class="form-control bg-dark text-light" required autofocus placeholder="Enter Your Question Here"></textarea>
     <br/>

     <label for="question" class="text-capitalize p-2" >enter first answer</label>
     <input type="text" name="ans1" id="ans1" placeholder="Enter First Answer" required autocomplete="off" class="form-control text-light">
      
     <br/>

     <label for="question" class="text-capitalize p-2" >enter second answer</label>
     <input type="text" name="ans2" id="ans2" placeholder="Enter Second Answer" required autocomplete="off" class="form-control text-light">
      
     <br/>

     <label for="question" class="text-capitalize p-2" >enter third answer</label>
     <input type="text" name="ans3" id="ans3" placeholder="Enter Third Answer" required autocomplete="off" class="form-control text-light">
      
     <br/>

     <label for="question" class="text-capitalize p-2" >enter fourth answer</label>
     <input type="text" name="ans4" id="ans4" placeholder="Enter Fourth Answer" required autocomplete="off" class="form-control text-light">
      
     <br/>
     <label for="question" class="text-capitalize p-2" >enter correct answer</label>
     <input type="number" name="trueOpt" id="trueOpt" placeholder="Enter Correct Answer Number" required autocomplete="off" class="form-control text-light" min="1" max="4">
      
     <br/>


    <input type="submit" value="Add Question +" class="btn btn-danger   form-control w-75 m-auto" name="submit">


 </form>
 <br/>
 <br/>
<!-- <div class="admin_action_nav d-flex align-items-center justify-content-evenly"> -->
<button class="text-capitalize btn btn-secondary my-3"><a href="adminAddSubject.php" class="text-decoration-none text-center text-light">&lt;&lt; proceed to add subject <a/></button>
<button class="text-capitalize btn btn-secondary text-light my-3"><a href="adminAddTest.php" class="text-decoration-none text-center text-light">&lt;&lt; proceed to add test <a/></button>
<br/>
<br/>
<br/>
<!-- </div> -->
<button class="text-capitalize btn btn-primary text-light"><a href="adminCbtSettings.php" class="text-decoration-none text-center text-light"> proceed to configure cbt. &gt;&gt;<a/></button>

<br/>
 <br/>

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

#import the necessary modules
require_once "../errorLog.php";
require_once "../validateMethods.php";


#filter user inputs

#check if the admin clicks the add question button

if(isset($_POST["submit"]) AND $_SERVER["REQUEST_METHOD"] == serverMethod){

    $test_name_ID=mysqli_real_escape_string($conn,parse_inputs($_POST["testName"]));
    $question=mysqli_real_escape_string($conn,parse_inputs($_POST["question"]));
    $ans_1=mysqli_real_escape_string($conn,parse_inputs($_POST["ans1"]));
    $ans_2=mysqli_real_escape_string($conn,parse_inputs($_POST["ans2"]));
    $ans_3=mysqli_real_escape_string($conn,parse_inputs($_POST["ans3"]));
    $ans_4=mysqli_real_escape_string($conn,parse_inputs($_POST["ans4"]));
    $correctAns=mysqli_real_escape_string($conn,parse_inputs($_POST["trueOpt"]));
    $date_time_added=date("d/m/y")." - ".date("h:i:s:a");


    if(!empty($test_name_ID) AND !empty($question) AND !empty($ans_1) AND !empty($ans_2) AND !empty($ans_3) AND !empty($ans_4) AND !empty($correctAns)){

        #inputs were legit, prepare database connection
        #check if the connection was successful
        if(!$conn){
            echo '<script>
        
            swal.fire({
                title:"Error",
                text:"An error occured while connecting to database",
                icon:"error",
                allowOutsideClick:false
            });
    
            </script>';
            die();
        }
        #prepare the query
      
       $question_add_query="INSERT INTO users_questions (test_ID,question,opt_1,opt_2,opt_3,opt_4,true_ans,time_added) VALUES ('$test_name_ID','$question','$ans_1','$ans_2','$ans_3','$ans_4','$correctAns','$date_time_added')";
       $question_add_result=mysqli_query($conn,$question_add_query);

       if(!$question_add_result){
           #an error occured
           echo '<script>
        
           swal.fire({
               title:"Error",
               text:"An error occured while storing questions in the database",
               icon:"error",
               allowOutsideClick:false
           });
   
           </script>';
           unknown_error_msg();
           die();
       }else{
             #an error occured
           echo '<script>
        
           swal.fire({
               
               text:"Question added successfully , proceed to add new question..",
               icon:"success",
               allowOutsideClick:false
           });
   
           </script>';
        subject_added_success("Question");
       }


    }else{
        echo '<script>
        
        swal.fire({
            title:"Error",
            text:"No input must be left blank",
            icon:"error",
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