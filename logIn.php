<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="bootstrap.css">
<script src="jquery.slim.min.js"></script>
<script src="sweetAlert2.js"></script>

<link rel="stylesheet" href="msgConfig.css">


<title>User Login</title>
<style>

        body{
            background:#121212;
            color:white;
        }
        
        .errorLog{
            font-size:16px;
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
        .form{
            width:50%;
        }
    }

</style>
</head>
<body class="p-0 d-flex justify-content-center m-auto flex-column align-items-center">


<div class="container-fluid p-3 m-auto">

<h4 class="text-center text-capitalize" id="header_msg">welcome chief 😎</h4>
<br/>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="m-auto  p-4 form rounded shadow bg-dark text-light">
 <h5 class="text-center text-capitalize">Login ⚡</h5>
<br/>
<div class="errorLog rounded p-2 justify-content-center align-items-center text-center text-light" id="errorLog"  style="background:tomato;"></div>
<label for="username" class="py-2">Username:</label>
<br/>

<input type="text" class="form-control loginInputs text-light" placeholder="Enter Your Username..." name="username" required autocomplete="off" >
<br/>
<br/>

<label for="password" class="py-2">Password:</label>
<br/>

<input type="password" class="form-control loginInputs text-light" placeholder="Enter Your Password..." name="password" required>
<br/>
<br/>
<button class="btn btn-danger text-capitaize text-center" name="submit">✨ Login
 
</button>
<hr/>
        <p class="text-capitalize d-block">new here 
        <button class="btn btn-primary text-capitalize text-center text-light">
            <a href="signUp.php" class="text-decoration-none text-light text-center"> ✨ Sign Up</a>
        </button>
    </p>
    <hr/>
  
</form>


</div>
<br/>
<br/>
<?php require_once "footer.php";?>

<?php

require "errorLog.php";
require "validateMethods.php";
require "conn.php";


if(!empty($_SESSION["ID"])){
  
    echo '<script>
    location.href="index.php";
    </script>';
}

#admin login is false by default
$admin_login=false;
#create a cookie and set the expiry date to after 30 days
#this is how many seconds in a day multiplied by 30 days
$cookieExpDate=(86400) * 30;

if(isset($_POST["submit"]) and $_SERVER["REQUEST_METHOD"]==serverMethod){

    #if the submit is clicked and the admin radio btn is empty then it is a user login else it is an admin login
    if(empty($_POST["admin-login-btn"])){
        $admin_login=false;
        goto validateUser;
    }

    if(!$conn){
        echo '<script>

        swal.fire({
            title:"An Error OCcured",
            text:"An unknown error occured!",
            icon:"error"
        });



        </script>';

        die();
    }

validateUser:

    $user_name=@mysqli_real_escape_string($conn,parse_inputs($_POST["username"]));
    $password=sha1(mysqli_real_escape_string($conn,parse_inputs($_POST["password"])));

    #check if the username exists in the database
    $query="SELECT * FROM users WHERE user_name = '$user_name' ";
    $result=@mysqli_query($conn,$query);
    $row=@mysqli_fetch_assoc($result);
    
    if(mysqli_num_rows($result) > 0){

        if($password === $row["password"]){
            #create the cookie for the user id
            setcookie("ID",$cookieExpDate);
           
            #create the cookie for the login boolean
            setcookie("login",$cookieExpDate);
            
            #init each cookie to their independent values
            $_COOKIE["login"]=true;
          
            $_COOKIE["ID"]=$row["ID"];

            #set the session variables to each cookie independent value
            $_SESSION["login"]=$_COOKIE["login"];
            $_SESSION["ID"]=$_COOKIE["ID"];

            
            #update the user's status to online which is 1
            $user_status=1;
            $ID=$_SESSION["ID"];
            $update_user_query="UPDATE users SET status = '$user_status' WHERE ID ='$ID';";
            $update_user_query.="UPDATE users_info SET status ='$user_status' WHERE U_ID ='$ID'";
            $update_user_result=@mysqli_multi_query($conn,$update_user_query);

            if(!$update_user_result){
                
                unknown_error_msg();
            }else{
                 #close the connection
                mysqli_close($conn);
               
                correct_login_details();
                echo '<script>
                setTimeout(()=>{
                    location.href="index.php";  
                },3000);
                
                </script>';
               
            }

           
    
          }else{
                #password is wrong
                wrong_login_details();
    
            }     
    }else{
        #user does not exist
        user_not_exist();
    }
}


?>

</body>
</html>