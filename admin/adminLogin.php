<?php

require_once "../conn.php";

#connect to the database

if(!empty($_SESSION["Admin_ID"])){
    #this means someone is logged in
    echo '<script>
        location.href="index.php";
    </script>';
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
<script src="../jquery.slim.min.js"></script>
<script src="../sweetAlert2.js"></script>
<link rel="stylesheet" type="text/css" href="../msgConfig.css"/>
<title>Admin Login</title>
<style>

        body{
			background:#121212;
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
    <br/>
<h4 class="text-capitalize mt-3 text-center text-light">welcome boss 😎</h4>

<br/>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="m-auto  p-4 form rounded shadow bg-dark text-light">
<h5 class="text-center text-capitalize">Admin Login ⚡</h5>
<br/>
<div class="errorLog rounded p-2 justify-content-center align-items-center text-center text-light" id="errorLog"  style="background:tomato;"></div>
<label for="username" class="py-2">Admin Username:</label>
<br/>

<input type="text" class="form-control loginInputs text-light" placeholder="Enter Your Username..." name="ad_username" required autocomplete="off" autofocus >
<br/>
<br/>

<label for="password" class="py-2">Admin Password:</label>
<br/>

<input type="password" class="form-control loginInputs text-light" placeholder="Enter Your Password..." name="ad_password" required>
<br/>
<br/>
<hr/>
<input class="btn btn-danger text-capitaize text-center" type="submit" value="Login ✨" name="ad_submit">
<hr/>
 
</form>

</div>


<br/>
<br/>
<?php require_once "../footer.php";?>

<?php

#validation occurs here

require_once "../conn.php";
require_once "../errorLog.php";
require_once "../validateMethods.php";

#password is eagt_admin


if(isset($_POST["ad_submit"]) AND $_SERVER["REQUEST_METHOD"]==serverMethod){
    #filter the inputs and encrypt the password
    $ad_username=mysqli_real_escape_string($conn,parse_inputs($_POST["ad_username"]));
    $ad_password=sha1(mysqli_real_escape_string($conn,parse_inputs($_POST["ad_password"])));
    
    #create a cookie and set the expiry date to after 30 days
    #this is how many seconds in a day multiplied by 30 days
    $cookieExpDate=(86400) * 30;

    #check if the connection is well
    if(!$conn){
        #an error occured
        unknown_error_msg();
    }    

    #check if the values match the database values
    $admin_validate_query="SELECT * FROM admin WHERE user_name = '$ad_username'";
    $admin_validate_result=@mysqli_query($conn,$admin_validate_query);
    $admin_row=@mysqli_fetch_assoc($admin_validate_result);
    if($admin_validate_result){
        if(mysqli_num_rows($admin_validate_result) > 0){
            
            if($ad_password == $admin_row["password"]){
                #update the dbase for the online status
                $admin_status=1;
                $ID=$admin_row["ID"];
               
                $update_admin_status="UPDATE admin SET status ='$admin_status' WHERE ID = '$ID';";
                $update_admin_status.="UPDATE admin_info SET status ='$admin_status' WHERE A_ID ='$ID'";
                $update_query_result=mysqli_multi_query($conn,$update_admin_status);

                if(!$update_query_result){
                    #an error occured
                    unknown_error_msg();
                }else{
                    
                    #create the session and cookie variable
                    setcookie("Admin_ID",$cookieExpDate);
                    
                    #create the cookie for the admin login boolean
                    setcookie("ad_login",$cookieExpDate);
                    
                    #init each cookie to their independent values
                    $_COOKIE["ad_login"]=true;
                    $_COOKIE["Admin_ID"]=$admin_row["ID"];
        
                    #set the session variables to each cookie independent value
                    $_SESSION["ad_login"]=$_COOKIE["ad_login"];
                    $_SESSION["Admin_ID"]=$_COOKIE["Admin_ID"];

                    correct_login_details();
                    echo '<script>

                        $(document).ready(($)=>{
                            setTimeout(()=>{
                                location.href="index.php";
                            },3000);
                        });
                    </script>';
                }

            }else{
                 #invalid username or password
                 wrong_admin_login_details();
            }
 
        }else{
            
                #invalid username or password
                wrong_admin_login_details();
        }
    }else{
        die("an error occured ".mysqli_error($conn));
    }





}

?>

</body>
</html>