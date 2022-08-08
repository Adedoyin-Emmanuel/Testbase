<?php

require_once "conn.php";

#connect to the database

if(!empty($_SESSION["ID"])){
	#this means someone is logged in
	$ID=$_SESSION["ID"];
	$query="SELECT * FROM users WHERE ID = '$ID' ";
	$result=mysqli_query($conn,$query);
	$row=mysqli_fetch_assoc($result);

	  #perform another query
      $user_info_query="SELECT * FROM users_info WHERE U_ID = '$ID'";
      $user_info_result=mysqli_query($conn,$user_info_query);
      $user_info_row=mysqli_fetch_assoc($user_info_result);
    
    
      if(!$user_info_result){
        header("Location: index.php");
      }
    

}else{
	header("Location: login.php");
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="bootstrap.css"/>
<script src="jquery.slim.min.js"></script>
<script src="sweetAlert2.js"></script>
<link rel="stylesheet" href="msgConfig.css"/>
<title>Change Profile</title>


<style>

body{
    background:#121212;
}

.form{

		}
		input[type=text],input[type=password],input[type=email],input[type=number],textarea  {
        color:white;

		}

    input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill:hover,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill:focus,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date]:-webkit-autofill:active{
          -webkit-box-shadow: 0 0 0 30px #343a40 inset !important;
    }
    textarea{
      resize: none;
      background-color:#343a40;
    }
    		.errorLog{
            display:none;
        }

.d-btn{
  background:#121212;
  border-color:white;
  color:black;

}


  ::-webkit-scrollbar{
    width:7px;
    height:7px;
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


</style>
</head>

<body class="p-0 d-flex justify-content-center m-auto flex-column align-items-center">
<div class="container-fluid  m-auto text-light p-0">
<?php require_once "nav.php";?>


<section class="text-capitalize p-4 m-auto text-center">
    <div class="d-flex justify-content-start align-items-center p-4">
    <img src="<?php echo "profilePic/".$user_info_row["profile_picture"]?>" height="50" width="50" class="rounded-circle" alt="<?php echo $user_info_row["user_name"]. " " . "profile picture"?>"/>
    <h4 class="text-capitalize text-center p-3" >welcome <?php echo $row["user_name"]?></h4>
</div>
dear <?php echo $row["user_name"]?>, change your profile information below, choose the profile information type you want to change and proceed below
</section>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" class="m-auto  p-4 form rounded shadow bg-dark text-light my-3" method="POST" enctype="multipart/form-data">
<h3 class="text-capitalize text-center">change your profile details</h3>
<br/>
<div class="errorLog rounded p-2 justify-content-center align-items-center text-center text-capitalize text-light" id="errorLog" style="background:tomato;"></div>
<hr/>

<label for="email" class="text-capitalize ">E-mail:</label>
<br/>
<input type="email" placeholder="Update Your E-mail" class="form-control text-light " name="email" required autofocus value="<?php echo $user_info_row["email"] ?>"/>
<br/>

<label for="homeAddress" class="text-capitalize ">Home-Address:</label>
<br/>
<input type="text" placeholder="Update Your Home-Address" class="form-control text-light" name="homeAddress" required value="<?php echo $user_info_row["home_address"] ?>"/>
<br/>

<label for="phoneNumber" class="text-capitalize ">Phone-Number</label>
<br/>
<input type="number" placeholder="Update Your Phone-Number" class="form-control text-light" name="phoneNumber" required value="<?php echo $user_info_row["phone_number"] ?>"/>
<br/>

<label for="birthday" class="text-capitalize ">Birthday:</label>
<br/>
<input type="date" placeholder="Update Your Birthdate" class="form-control form text-light" name="birthday" required value="<?php echo $user_info_row["birthday"] ?>"/>
<br/>

<label for="comment" class="text-capitalize ">Update Your Bio:</label>
<br/>
<textarea placeholder="Update Your Comment" class=" text-light w-100 text-capitalize text-area rounded" name="comment" required>
<?php echo $user_info_row["comment"] ?>
    </textarea>

<br/>

<h5 class="text-capitalize text-bold">Sex</h5>
<input type="radio" value="male" class="d-inline radio-btn" name="gender" required /> <p class="text-capitalize d-inline ">male</p>
<br/>
<input type="radio" value="female" class="d-inline radio-btn" name="gender" required /> <p class="text-capitalize d-inline ">Female</p>

<br/>
<hr/>
<h5 for="profilePic" class="text-capitalize text-bold">profile picture</h5>
<br/>
<input type="file" value="profilePic" class="form-control-file border bg-dark p-2 text-light w-75" name="profilePic" id="profilePic" required>
<br/>
<hr/>

<button class="btn btn-primary form-control text-center text-capitalize" name="submit"> update profile</button>
<br/>
<br/>
<button class="btn btn-primary d-btn text-center text-capitalize m-auto"> <a href="index.php" class="text-capitalize text-light text-center text-decoration-none"> &lt;&lt; back to dashboard</a></button>
</form>

</div>

<?php

#import all the required modules
require_once "errorLog.php";
require_once "validateMethods.php";

#validation occurs here.

require_once "conn.php";

#validation occurs here.


#check if the use clicked the sumbit button
if(isset($_POST["submit"]) and  $_SERVER["REQUEST_METHOD"]==serverMethod){
  
  //sanitize the inputs 
  $email=mysqli_real_escape_string($conn,parse_inputs($_POST["email"]));
  $homeAddress=mysqli_real_escape_string($conn,parse_inputs($_POST["homeAddress"]));
  $phoneNumber=mysqli_real_escape_string($conn,parse_inputs($_POST["phoneNumber"]));
  $birthday=mysqli_real_escape_string($conn,parse_inputs($_POST["birthday"]));
  $bio=mysqli_real_escape_string($conn,parse_inputs($_POST["comment"]));
  $sex=mysqli_real_escape_string($conn,parse_inputs($_POST["gender"]));
  $profilePic=$_FILES["profilePic"];

	
	#reference the file upload folder
	$upload_dir= "profilePic/";
	#create a file size constant
	#this is 1mb
	$max_file_size=1000000;
	


  #check if the inputs are empty
  if(!empty($email) and !empty($homeAddress) and !empty($phoneNumber) and !empty($birthday) and !empty($bio) and !empty($sex) and !empty($profilePic)){
    
    #the inputs are not empty
    #check if the email is legit
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			#throw an error to the user
			invalid_email();
		}

    #check for the database connection
    if(!$conn){
      #an unknown error
      unknown_error_msg();
    }else{
      #test if the user exists
      $user_exist_query="SELECT * FROM users_info WHERE U_ID = $ID";
      $user_exist_result=mysqli_query($conn,$user_exist_query);

      if(!$user_exist_result){
        #an error occurred during the process
        unknown_error_msg();
      }else{
        if(mysqli_num_rows($user_exist_result) ==1){
          #the user exist
          #check for the fil upload
          $file_upload_name=$profilePic["name"];
          $file_temp_name=$profilePic["tmp_name"];
          $file_upload_size=$profilePic["size"];
          $file_match_success=false;
          $file_upload_error=$profilePic["error"];

          #get the legit file extension
          $file_ext=explode('.',$file_upload_name);
          $legit_file_ext_array=array("png","jpg","jpeg","gif");
          $legit_ext=strtolower(end($file_ext));
          $randomNumber=rand(1,999999999999);
          $randomTime=time();
          $new_file_name=$randomNumber.$randomTime.".".$legit_ext;
          $target_file_dir=$upload_dir.$new_file_name;

          #check if there was an error
          if($file_upload_error !=0){
            die("an error occured while processing the file");
            #unknown_file_error();
          }
          #check if the file is too big
          if($file_upload_size > $max_file_size){
            large_uploaded_file();
          }
          #check if the user image extension matches with thr legit extension
          if(in_array($legit_ext,$legit_file_ext_array)){
            $file_match_success=true;

            #prepare the query to update the user's profile
            $timeUpdated=date("d/m/y")." - ".date("h:i:s:a");
            $update_profile_query="UPDATE users_info SET email ='$email', birthday ='$birthday', sex ='$sex', comment ='$bio', home_address ='$homeAddress', phone_number ='$phoneNumber', profile_picture ='$new_file_name', time_updated ='$timeUpdated' WHERE U_ID = '$ID'";
            $update_query_result=mysqli_query($conn,$update_profile_query);

            #check if there was an error
            if(!$update_query_result){
              #an error occurred 
              #unknown_error_msg();
              die("an error occured while updating the profile".mysqli_error($conn));
            }else{
               #everything was successful, move the uploaded file
               if($file_match_success==true){
                 #check if the process of moving the file was successful
                 if(move_uploaded_file($file_temp_name,$target_file_dir)){
                   #close the mysqli connection
                   mysqli_close($conn);
                  profile_change_success();

                  #header("Location: index.php");
                 }else{
                   #an error occured
                   unknown_file_error();
                 }
               }
            }
          }else{
            wrong_file_extension();
          }


        }else{
          profile_server_error();
        }
      }
    }

  }else{
    #one of the inputs are empty
    incomplete_update_error();
  }
}

?>
</body>
</html>