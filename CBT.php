
<?php

error_reporting(2);
require_once "conn.php";
extract($_POST);
extract($_GET);
extract($_SESSION);



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CBT</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">

    <script src="bootstrap.js"></script>
    <script src="jquery.slim.min.js"></script>
    <script src="sweetAlert2.js"></script>


        
<style>
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
	width:15px;
	height:15px;
	outline:2px solid white;
	background:green;
	transform:translate(57px,-8px);

    
	
}


.status_offline{
	width:15px;
	height:15px;
	outline:2px solid white;
	background:grey;
	transform:translate(57px,-8px);
	
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
    background:#121212;
   }

.nav{
    background:lightgreen;
    
}

.subjects:hover{
    color:blue;
}



</style>
</head>
<body class="text-light">



<?php


if(!empty($_SESSION["ID"])){
	#this means someone is logged in
	$ID=$_SESSION["ID"];
	$query="SELECT * FROM users WHERE ID = $ID";
	$result=@mysqli_query($conn,$query);
	$row=@mysqli_fetch_assoc($result);

    $user_info_query="SELECT * FROM users_info WHERE U_ID = $ID";
    $user_query_result=@mysqli_query($conn,$user_info_query);
    $user_info_row=@mysqli_fetch_assoc($user_query_result);
    

    


    #check if the cbt sessions are set, other wise set them
    if(!isset($_SESSION["question_number"]) OR !isset($_SESSION["true_answer"])){
        #delete the user answer
        $delete_answer_query="DELETE FROM user_answer WHERE user_ID='$ID'";
        $delete_result=mysqli_query($conn,$delete_answer_query);
        if(!$delete_result){
            die("<h3 class='text-capitalize text-danger text-center'>An error occured while processing</h3>".mysqli_error($conn));
        }
         $_SESSION["question_number"]=0;
         $_SESSION["true_answer"]=0;
 
     }
 
}else{
	header("Location: login.php");
}

?>


<?php




?>
<?php require_once "nav.php";?>
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
    <h3 class="text-capitalize text-center p-3" >welcome <?php echo $row["user_name"]?></h3>
</div>

<br/>

<?php
    $get_questions_query="SELECT * FROM users_questions WHERE test_ID = $_SESSION[t_id]";
    $get_questions_result=mysqli_query($conn,$get_questions_query);
      #get total question length
    $get_question_length_query="SELECT * FROM users_test WHERE subject_ID=$_SESSION[s_id]";
    $get_question_length_result=mysqli_query($conn,$get_question_length_query);
    $question_length_row=mysqli_fetch_array($get_question_length_result);


    
    
   
   
           #check if the next_question button was clicked
  if(isset($_POST["next_question"]) AND $_SERVER["REQUEST_METHOD"] == serverMethod){

    
    $real_answer=mysqli_real_escape_string($conn,parse_inputs($_POST["checker"]));
    $user_answer=mysqli_real_escape_string($conn,parse_inputs($_POST["opt"]));


    if(!isset($opt) OR empty($opt)){
        echo '<script>
            swal.fire({
                text:"Abeg select an option to proceed",
                icon:"error",
                timer:3000
    
            });
            </script>';
        echo "<br/>";
        echo "<br/>";
        die('<button class="btn btn-primary text-capitalize text-center text-light"><a class="text-decoration-none text-center text-light" href="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">&lt;&lt; Back to question</a></button>');
    }


    
    if(sha1(md5($opt)) == $real_answer){
        $_SESSION["true_answer"]+=1;

    }
 
    $timeUpdated=date("d/m/y")." - ".date("h:i:s:a");
    $time_submitted=date("h:i:s:a");
    mysqli_data_seek($get_questions_result,$_SESSION["question_number"]);
    $questions_row=mysqli_fetch_array($get_questions_result);
    $question_insert_query=@"INSERT INTO user_answer (user_ID,test_ID,question,opt_1,opt_2,opt_3,opt_4,true_ans,user_ans,date_added) VALUES ('$ID',".$_SESSION[t_id].",'$questions_row[2]','$questions_row[3]','$questions_row[4]','$questions_row[5]','$questions_row[6]','$questions_row[7]','$user_answer','$time_submitted')";
    $question_insert_result=mysqli_query($conn,$question_insert_query);
    
    if(!$questions_row){
        die("an error occured".mysqli_error($conn));
    }
    #check if there was a error
    if(!$question_insert_result){
        echo '<script>
        
        swal.fire({
            title:"Fatal Error",
            text:"An error occured please restart the test",
            icon:"error",
            showCancelButton:true,
            showConfirmButton:true


        }).then((willProceed)=>{
            if(willProceed.isConfirmed){
                location.href="index.php";
            }
        })

        </script>';
        echo mysqli_error($conn);
        die("<h3 class='text-capitalize text-center text-danger'>An error occured </h3>".mysqli_error($conn));
        
    }

    
    

    
    
    $_SESSION["question_number"] += 1;
}
    
    
    #check if the user clicked the previous question
    if(isset($_POST["previous_question"]) AND $_SERVER["REQUEST_METHOD"] ==serverMethod){
        echo "previous question";

        #decrement the question session
         $_SESSION["question_number"]-=1;
        
         $_SESSION["true_answer"]=$_SESSION["true_answer"]-1;

    }

    #check if the user clicked the get result button
    if(isset($_POST["get_result"]) AND $_SERVER["REQUEST_METHOD"] == serverMethod){
                #get the real answer from the question form
                $real_answer=mysqli_real_escape_string($conn,parse_inputs($_POST["checker"]));
            
                #check if the answer matches with the user anser
                if(sha1(md5($opt)) == $real_answer){
                    $_SESSION["true_answer"]+=1;
            
                }
                #increment the question session
                $_SESSION["question_number"]+=1;



                mysqli_data_seek($get_questions_query,$_SESSION["question_number"]);
                $questions_row=mysqli_fetch_array($get_questions_result);
                
                echo '<h6 class="test_status text-right text-dark p-2" id="test_status"></h6>';

                echo '<script>
                    
                //use jquery to get the element and insert the data to it
                
                $(document).ready(() => {
                    //get the element
                    $("#test_status").text("CBT completed!");
                    $("#test_status").removeClass("text-dark");
                    $("#test_status").addClass("text-danger");
                });

                
                </script>';

                if(!isset($opt) OR empty($opt)){
                    echo '<script>
                        swal.fire({
                            text:"Abeg select an option to proceed",
                            icon:"error",
                            timer:3000
                
                        });
                        </script>';
                    echo "<br/>";
                    echo "<br/>";
                    die('<button class="btn btn-primary text-capitalize text-center text-light"><a class="text-decoration-none text-center text-light" href="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">&lt;&lt; Back to question</a></button>');
                }
                if(!$questions_row){
                    die("an error occured".mysqli_error($conn));
                }
                $timeUpdated=date("d/m/y")." - ".date("h:i:s:a");
                $time_submitted=date("h:i:s:a");
                #insert the user answer into the database
                #array number index represent individual databae columns
        
                $question_insert_query="INSERT INTO user_answer (user_ID,test_ID,question,opt_1,opt_2,opt_3,opt_4,true_ans,user_ans,date_added) VALUES ('$ID',".$_SESSION[t_id].",'$questions_row[2]','$questions_row[3]','$questions_row[4]','$questions_row[5]','$questions_row[6]','$questions_row[7]','$opt','$time_submitted')";
                $question_insert_result=mysqli_query($conn,$question_insert_query);
        
                #check if there was a error
                if(!$question_insert_result){
                    echo '<script>
                    
                    swal.fire({
                        title:"Fatal Error",
                        text:"An error occured please restart the test",
                        icon:"error",
                        showCancelButton:true,
                        showConfirmButton:true
        
        
                    }).then((willProceed)=>{
                        if(willProceed.isConfirmed){
                            location.href="index.php";
                        }
                    })
        
                    </script>';
                    die("<h3 class='text-capitalize text-center text-danger'>An error occured </h3>".mysqli_error($conn));
                }
        
                
                
        
                #check if the user's answer matches with the database answer 
                $wrong_answer=abs($_SESSION["question_number"] - $_SESSION["true_answer"]);
                $pass_percentage=($_SESSION["true_answer"])/($question_length_row["total_questions"]) * 100 ;

                if($pass_percentage >= 50){
                    echo '<script>
                    $("#pass_percentage").removeClass("text-danger");
                    $("#pass_percentage").addClass("text-success");
                    </script>';
                }else{
                    echo '<script>
                    $("#pass_percentage").removeClass("text-success");
                    $("#pass_percentage").addClass("text-danger");
                    </script>';
                }

                echo '
                
                                
                   <div class="text-capitalize  d-flex flex-column align-items-center justify-content-center p-5 m-auto">
                   
                   <h3 class="text-capitalize text-light m-auto"> cBT result</h3>
                   <br/>

                   <h4 class="text-light text-capitalize ">Total questions answered: '.$_SESSION["question_number"].' out of '.$question_length_row["total_questions"].'<h4>
                   <br/>

                   <h5 class="text-success text-capitalize ">correct answers: '.$_SESSION["true_answer"].'</h5>
                   <br/>
                   
                   <h5 class="text-danger text-capitalize ">wrong answers: '.$wrong_answer.'</h5>
                   <br/>

                   <h5 class="text-light text-capitalize " id="pass_percentage">pass percentage: '.floor($pass_percentage).'%</h5>
                   <br/>
                   
                   
                    <div class="d-flex text-captitalize align-items-center justify-content-evenly flex-column">
                        
                    <button class="btn btn-danger text-capitalize text-center"><a href="cbtReview.php" class="text-decoration-none text-light">review CBT questions<a/></button>


                    <br/>
                    <button class="btn btn-primary text-capitalize text-center"><a href="index.php" class="text-decoration-none text-light">back to dashboard<a/></button>
                    <br/>
                    <button class="btn btn-success text-capitalize text-center"><a href="takeCbt.php" class="text-decoration-none text-light">restart CBT<a/></button>

                    <br/>
                    </div>
                    
                    <br/>

                    
                   </div>
                ';
                
               
                #remove all the session variables and destroy them
                unset($_SESSION["question_number"]);
                unset($_SESSION["true_answer"]);
                unset($_SESSION["t_id"]);
                unset($_SESSION["s_id"]);

                die();


    }




            if(isset($test_ID) && isset($sub_ID)){
                $_SESSION["t_id"]=$test_ID;
                $_SESSION["s_id"]=$sub_ID;
            
            
                header("Location:CBT.php");

            
            }





            if(!isset($_SESSION["t_id"]) OR !isset($_SESSION["s_id"])){
                
            header("Location:index.php");
            }


?>

<?php




if(true){
   

if(!$conn){
    echo '<script>
            swal.fire({
                text:"An error occured during the connection",
                icon:"error",
                title:"Fatal Error"
    
            });
    </script>';
    die("<h4 class='text-capitalize text-danger text-center'>A fatal error occured please contact admin to resolve this error</h4>");
}

if(!$get_questions_result){
    echo '<script>
            swal.fire({
                text:"An error occured while getting questions",
                icon:"error",
                title:"Fatal Error"
    
            });
    </script>';
    die("<h4 class='text-capitalize text-danger text-center'>A fatal error occured please contact admin to resolve this error</h4>".mysqli_error($conn));
}else{

    
    #check if the session question is greater than the total question
    if($_SESSION["question_number"] > mysqli_num_rows($get_questions_result) - 1){
        //unset($_SESSION["question_number"]);
        //$_SESSION["question_number"]=undefined;
        // echo '<script>
        // swal.fire({
        //     text:"An error occured, please contact admin or restart the exam",
        //     icon:"error",
        //     title:"Fatal Error",
        //     showCancelButton:true,
        //     confirmButtonText:"Restart CBT"

        // }).then((willProceed)=>{
        //     if(willProceed.isConfirmed){
        //         location.href="takeCbt.php";
        //     }
        // })
        // </script>';
        //die("<h4 class='text-capitalize text-danger text-center'>A fatal error occured please contact admin to resolve this error</h4>");
    }
  
    #get the questions with an incrementing index
    
    mysqli_data_seek($get_questions_result,$_SESSION["question_number"]);
    $questions_row=mysqli_fetch_array($get_questions_result);

    #increment the question session to get the legit question number
    $current_question_number=$_SESSION["question_number"] + 1;

    #check if the question is empty or not
    if(empty($questions_row)){
       echo '<script>
       
       swal.fire({
            title:"Error",
            text:"An error occured, questions not found",
            icon:"error"

       })

       </script>';
       
       
       echo("<h4 class='text-capitalize text-center text-danger'>an error occured please contact admin to solve this issue</h4>");
       echo "<br/>";
       die ('<div class="d-flex align-items-center justify-content-around m-auto p-3">
       
       <button class="text-capitalize text-center btn btn-primary"><a href="takeCbt.php" class="text-decoration-none text-light text-capitalize">restart CBT</a></button>
       <button class="text-capitalize text-center btn btn-danger"><a href="contactAdmin.php" class="text-decoration-none text-light text-capitalize">contact admin</a></button>
       </div>');
    }

    $questions_data='
            
    <div class="questions_div text-capitalize d-flex align-items-start justify-content-evenly flex-column">
    <h6 class="test_status text-right text-light p-2" id="test_status"></h6>
    <h5 class="question_counter text-center m-auto text-danger text-capitalize">question '.$current_question_number.' out of '.$question_length_row["total_questions"].'</h5>
    <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" name="question_form" method="POST" class="m-3">
    <h5 class="p-2 m-2" name="questions">'.$questions_row["question"].'</h5>
    <input type="radio" name="opt" id="" value="1">'.$questions_row["opt_1"].'
    <br/>
    <input type="radio" name="opt" id="" value="2">'.$questions_row["opt_2"].'
    <br/>
    <input type="radio" name="opt" id="" value="3">'.$questions_row["opt_3"].'
    <br/>
    <input type="radio" name="opt" id="" value="4">'.$questions_row["opt_4"].'
    <br/>
    <input type="text" value="'.sha1(md5($questions_row[7])).'" name="checker" hidden>

    <br/>
    <br/>
    
    



    ';

    echo $questions_data;
    #check if the user is not on the last question
    if($_SESSION["question_number"] < mysqli_num_rows($get_questions_result) -1){
        $button_data='
        
        <div class="button_nav -flex align-items-center justify-content-evenly text-capitalize">
        <button type="submit" class="btn btn-primary text-capitalize" name="next_question">Next Question  &gt;&gt;</button>
        </div>

        </div>
        ';

        echo $button_data;
        if(!isset($_POST["get_result"])){
            echo '<script>
            
            //use jquery to get the element and insert the data to it
            
            $(document).ready(() => {
                //get the element
                $("#test_status").text("CBT is now in sesssion!");
            });

            
            </script>';
        }else{
            echo '<script>
            
            //use jquery to get the element and insert the data to it
            
            $(document).ready(() => {
                //get the element
                $("#test_status").text("CBT completed!");
                $("#test_status").removeClass("text-light");
                $("#test_status").addClass("text-danger");
            });

            
            </script>';
        }
    }else{
        echo '<script>
                    
        //use jquery to get the element and insert the data to it
        
        $(document).ready(() => {
            //get the element
            $("#test_status").text("Last Question!");
            $("#test_status").removeClass("text-light");
            $("#test_status").addClass("text-danger");
        });

        
        </script>';
        $get_result_btn='
        <button type="submit" class="btn btn-dark text-light text-capitalize" name="get_result">Get your result &gt;&gt;</button>
     
        </div>
        ';

        echo $get_result_btn;
        
    }

    #check if the user has answered the first question
    if($_SESSION["question_number"] > 0){
            $previous_btn='
            <button type="submit" class="btn btn-danger m-2 text-capitalize" name="previous_question">&lt;&lt; previous question</button>

           
            </div>
            ';

            echo $previous_btn;
    }

   

}

 


}


?>



</body>
</html>