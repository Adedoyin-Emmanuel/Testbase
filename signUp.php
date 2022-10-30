
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here"/>
	<script src="jquery.slim.min.js"></script>
	<script src="sweetAlert2.js"></script>
        
        
        <link rel="stylesheet" href="msgConfig.css"/>
  
        <noscript>This application requires javaScript to run</noscript>
    <style>
        body{
            background:#121212;
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

    input::selection{
        color:white;
    }

        .errorLog{
            font-size:16px;
            display:none;
            


        }


    @media  (min-width: 992px) {
        .form{
            width:50%;
        }
    }



    </style>
    <link rel="stylesheet" href="msgConfig.css">

</head>
<body class="p-0 d-flex justify-content-center m-auto flex-column align-items-center">

<h4 class="text-capitalize mt-3 text-center text-light">welcome chief 😎 </h4>
<!-- 
<section class="text-capitalize text-left d-flex justify-content-center  flex-column p-3">
this is a project built to review and test my knowledge on backend development.. the project is fully backend, the cbt is a flexible tool to set different questions and also take tests with it.
fill the form below to create an account.. read more about this CBT 
</section>
<br/> -->
<div class="container-fluid p-3 m-auto ">

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="signUp" method="POST"  class="m-auto  p-4 form rounded shadow bg-dark text-light" autocomplete="off">
<h5 class="text-center text-capitalize">sign up 🚀</h5>
<div class="errorLog rounded p-2 justify-content-center align-items-center text-center text-light  py-2 my-2" id="errorLog"style="background:tomato;"></div>
<label for="userName" class="py-2">Username:</label>
<br/>
<input type="text" name="username" class="form-control text-light" id="userName" placeholder="Enter Your Username... eg Kgifty" required autocomplete="off"/>
<br/>

<script>


</script>
    <label for="passWord" class="py-2">Password:</label>
<br/>
<input type="passWord" name="password" class="form-control pCheck text-light" id="passWord"  placeholder="Enter Your Password..." required/>
<br/>
<label for="passWord" class="py-2">Confirm Password:</label>
<br/>
<input type="passWord" name="rePassword" class="form-control pCheck text-light py-2" placeholder="Confirm Your Password..."  id="retypePassword" required/>
<br/>
<button class="btn btn-primary text-center" name="submit" id="sign_up_submit">
    <span class="spinner-border spinner-border-sm text-light d-none" arial-hidden="true" id="spinner_submit"></span>
Sign Up ✨

</button>
<p class="d-block text-lowercase my-2">Creating an account means you have agreed to our <a href="">terms and condition</a> </p>
<hr/>
<p class="text-capitalized text-light d-block text-capitalize my-2">already have an account... 
    <button class="btn btn-danger text-light text-center mt-2"><a href="logIn.php" class="text-capitalize text-primary text-decoration-none text-light" >Login ✨</a></button>
</p>
<hr/>
</form>

</div>

<?php
 
 require "errorLog.php";
 require "validateMethods.php";
 require "conn.php";

if(!empty($_SESSION["ID"])){
    header("Location: index.php");
}

// if(!empty($_SESSION["admin-ID"])){
//     header("Location: adminDashboard.php");
// }

if(isset($_POST["submit"]) and $_SERVER["REQUEST_METHOD"]){
    $user_name=@mysqli_real_escape_string($conn,parse_inputs($_POST["username"]));
    #encrypt the passwords
    $password=@sha1(mysqli_real_escape_string($conn,parse_inputs($_POST["password"])));
    $re_password=@sha1(mysqli_real_escape_string($conn,parse_inputs($_POST["rePassword"])));
    $date_joined=date("d/m/y")." - ".date("h:i:s:a");
    
    if(empty($user_name) or empty($password)  or empty($re_password)){
       incomplete_details_error();
    }else{
        if($password==$re_password){
            #the passwords are the same check if the username exists
            if(!$conn){
                unknown_error_msg();
                die("could not connect to database");

            }else{
                $query="SELECT * FROM users WHERE user_name = '$user_name'";
                $result=@mysqli_query($conn,$query);
                if(mysqli_num_rows($result) > 0){
                    #the username already exists
                    #username_error();
                    die('the user name already exist'.mysqli_error($conn));
                }else{
                    #the username doesn't exist
                    #insert the user's data into the table
                    #$query .="INSERT INTO $unique_user_table (user_name,password) VALUES ('$user_name','$password');";
                    $query ="INSERT INTO users (user_name,password, date_joined) VALUES ('$user_name','$password','$date_joined')";
                    #create a unique table for each individual user
                    $result=@mysqli_query($conn,$query);
                    #check if the process was successful
                    if(!$result){
                        #unknown error occured
                        unknown_error_msg();
                        #die("Error occured while performing query".mysqli_error($conn));
                    }else{

                       
                        #update the user's info Id
                        #get the user personal id from the users table
                        $user_id_query="SELECT * FROM users WHERE user_name ='$user_name' AND password ='$password'";
                        $user_id_result=mysqli_query($conn,$user_id_query);
                        $user_id_row=mysqli_fetch_assoc($user_id_result);

                        if(!$user_id_result){
                            die("unable to fetch the user id".mysqli_error($conn));
                            #unknown_error_msg();
                        }

                        $ID=$user_id_row["ID"];
                        $user_info_query="INSERT INTO users_info (U_ID) VALUES ('$ID')";
                        $user_info_result=mysqli_query($conn,$user_info_query);

                        if(!$user_info_result){
                            die("could not update the user id".mysqli_error($conn));
                            #unknown_error_msg();
                        }else{
                            correct_signup_details();
                            #close the sqli connection
                            mysqli_close($conn);
                            #sleep(2);
                            echo '<script>
                                $(document).ready(($)=>{

                                    var $spinner_elem=$("#spinner_submit");
                                   $spinner_elem.removeClass("d-none");
                                   


                                   setTimeout(()=>{
                                        location.href="logIn.php";
                                   },3000);
                                }); 


                            </script>';
                            
                        }
                       
                    }
                }
            }
        }else{
            #password are not the same
            unmatch_password();
        }
    }


}

?>

<br/>
<br/>
<?php require_once "footer.php";?>
</body>
</html>