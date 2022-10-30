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
</style>
<title>Admin view Panel</title>
</head>
<body class="text-light ">

<div class="container-fluid p-0 ">
<?php require_once "adminNav.php";?>
<div class="d-flex align-items-center justify-content-around flex-row-reverse ">
<div class="data-area w-100 text-capitalize" id="data-area">
    <br/>
    <br/>
<div class="d-flex justify-content-center align-items-center p-4">
    
   <?php
         #$user_online_status=false;
         if($row["status"] == 1){
             
             echo '<img src="../profilePic/'.$admin_info_row["profile_picture"].'"'.'height="50" width="50" class="rounded-circle alt="profile_pic" "';
         }else{
           
            echo '<img src="../profilePic/'.$admin_info_row["profile_picture"].'"'.'height="50" width="50" class="rounded-circle alt="profile_pic" "';
         }
        ?>
        <br/>
    <h2 class="text-capitalize text-center p-3" >welcome <?php echo $row["user_name"]?></h2>
</div>
<!-- here is the data area -->


<?php

$counter=0;
$counter_array=array();
#action 0=> edit 1=> delete 2=>view


?>
<h4 class="text-capitalize">admin panel view questions</h4>
<br/>

<div class="questionAdd  p-5 shadow-lg bg-dark rounded-3 text-light flex-column">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="d-flex flex-column justify-content-center align-items-start">
<div class="errorLog rounded p-2 justify-content-center align-items-center text-center m-auto w-100 text-capitalize text-light" id="errorLog" style="background:tomato;"></div>
<br/>

<h4 class="text-capitalize text-center text-light m-auto">select test name to view</h4>
      

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

<br/>

<div class="d-flex align-items-center justify-content-center flex-column m-auto">
<button type="submit" class="btn btn-primary text-capitalize form-control m-auto " name="view_submit" >proceed to view questions </button>
<br/>
<br/>
<button  class="btn btn-danger text-capitalize form-control"><a href="adminCbtSettings.php" class="text-capitalize text-center text-decoration-none text-light">&lt;&lt; back to cbt settings</a> </button>

</div>
<?php

#check if the user clicked the proceed button

if(isset($_POST["view_submit"]) AND $_SERVER["REQUEST_METHOD"] == serverMethod){
    #check if none of the inputs are empty
$test_name=mysqli_real_escape_string($conn,parse_inputs($_POST["testName"]));

    if(!empty($test_name)){
        $test_name_ID=$test_name;
        #perform the query 
        $get_questions_query="SELECT * FROM users_questions WHERE test_ID ='$test_name_ID'";
        $get_questions_result=mysqli_query($conn,$get_questions_query);

        #check if the connection was successfuly
        if(!$conn){
            echo '<script>
        
            swal.fire({
                text:"An error occured while trying to connect to the database! try again later ",
                icon:"error",
                allowOutsideClick:false
            });
        
            </script>';
            die();
        }

        if(!$get_questions_result){
            echo '<script>
        
            swal.fire({
                text:"An error occured while querying the database! try again later ",
                icon:"error",
                allowOutsideClick:false
            });
        
            </script>';
            die();
        }else{
            if(mysqli_num_rows($get_questions_result) > 0){
                
                while($result_row=mysqli_fetch_assoc($get_questions_result)){
                    $counter++;
                    array_push($counter_array,$counter);
                    $data='
                    
                    
                    <br/>
      <p>question '.count($counter_array).'</p>
      <input type="number" value="'.$result_row["ID"].'" hidden name="q_ID'.count($counter_array).'"/>
     <label for="question" class="text-capitalize p-2"> your question</label>
     <textarea name="question" id="question" class="form-control" required autofocus placeholder="Enter Your Question Here" readonly>
     
     '. $result_row["question"].'
     </textarea>
     <br/>

     <label for="question" class="text-capitalize p-2" >first answer</label>
     <input type="text" name="ans1" id="ans1" placeholder="Enter First Answer" required autocomplete="off" class="form-control" value="'. $result_row["opt_1"].'" readonly>
      
     <br/>

     <label for="question" class="text-capitalize p-2" > second answer</label>
     <input type="text" name="ans2" id="ans2" placeholder="Enter Second Answer" required autocomplete="off" class="form-control" value="'. $result_row["opt_2"].'" readonly>
      
     <br/>

     <label for="question" class="text-capitalize p-2" > third answer</label>
     <input type="text" name="ans3" id="ans3" placeholder="Enter Third Answer" required autocomplete="off" class="form-control" value="'. $result_row["opt_3"].'" readonly>
      
     <br/>

     <label for="question" class="text-capitalize p-2" > fourth answer</label>
     <input type="text" name="ans4" id="ans4" placeholder="Enter Fourth Answer" required autocomplete="off" class="form-control" value="'. $result_row["opt_4"].'" readonly>
      
     <br/>
     <label for="question" class="text-capitalize p-2" > correct answer</label>
     <input type="number" name="trueOpt" id="trueOpt" placeholder="Enter Correct Answer Number" required autocomplete="off" class="form-control" min="1" max="4" value="'. $result_row["true_ans"].'" readonly>
      
     <br/>



    ';

    echo $data;

    

   }

 


            }else{
                echo '<script>
        
                swal.fire({
                    text:"No records retrived from database!  ",
                    icon:"error",
                    allowOutsideClick:false
                });
            
                </script>';
            }
        }

    }else{
        echo '<script>
        
        swal.fire({
            text:"Please select a test type ",
            icon:"error",
            allowOutsideClick:false
        });
    
        </script>';
        die();
    }
}




?>


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


</body>


<script src="adminPageNav.js"></script>
</html>