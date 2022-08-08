<?php

require_once "conn.php";

#connect to the database

if(!empty($_SESSION["ID"])){
	#this means someone is logged in
	$ID=$_SESSION["ID"];
	$query="SELECT * FROM users WHERE ID = '$ID' ";
	$result=@mysqli_query($conn,$query);
	$row=@mysqli_fetch_assoc($result);

	#perform another query
	$query3="SELECT * FROM users_info WHERE U_ID = $ID ";
	$result3=@mysqli_query($conn,$query3);
	$row3=@mysqli_fetch_assoc($result3);

	#check if that user has already completed his/her profile
	if(mysqli_num_rows($result3) > 0){
		#the user exists
		#check if the profile is completed
			#the user has already completed the profile
			if($row3["profile_updated"] == 1){
				echo "dear ".$row3["user_name"]." you have completed your profile";
				#if the user has completed the profile then navigate them back to the dashboard
				echo '<script>

				location.href="index.php";
				</script>';
			}else{
				
			}
	
	}else{
		//echo "error querying the dbase";
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
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="bootstrap.css">
<script src="bootstrap.js"></script>
<script src="jquery.slim.min.js"></script>

<title class="text-capitalize"><?php echo $row["user_name"]. " ". "profiile update" ?></title>
<noscript>This application requires javaScript to run</noscript>
<link rel="stylesheet" href="msgConfig.css"/>

<style>

body{
    background:#121212;
}

.form{
}
		 body{
    background: #121212;
    color:white;
   }


input[type=text],input[type=password],input[type=email],input[type=number],textarea  {
        color:white;

    }


    input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill:hover,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill:focus,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date]:-webkit-autofill:active{
          -webkit-box-shadow: 0 0 0 30px #343a40 inset !important;
    }

    

		.errorLog{
            display:none;
        }
</style>
</head>
<body class="p-0 d-flex justify-content-center m-auto flex-column align-items-center">
<div class="container-fluid p-0 m-auto text-capitalize ">
<?php require_once "nav.php";?>
<br/>
    <h3 class="text-capitalize text-center">Update Your Profile <?php echo $row["user_name"]?></h3>
	<p class="text-center text-capitalize">dear <?php echo $row["user_name"] ?>, please update your profile below.. this would help you to be easily noticable by other users.. it would also help our system hence.. proceed below</p>
<br/>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" class="m-auto w-100 bg-dark p-4 form rounded shadow" method="POST" enctype="multipart/form-data">
<h5 class="text-capitalize text-center bg-primary p-3 text-light"><?php echo $row["user_name"]?> profile's update</h5>
<br/>
<div class="errorLog rounded p-2 justify-content-center align-items-center text-center text-capitalize text-light" id="errorLog" style="background:tomato;"></div>
<hr/>
<label for="username" class="text-capitalize ">username:</label>
<br/>
<input type="text" placeholder="username already stored in server" class="form-control text-light" name="user_name"  readonly/>
<br/>
<label for="password" class="text-capitalize ">password:</label>
<br/>
<input type="password" placeholder="password already stored in server" class="form-control text-light" name="password" readonly/>
<br/>

<label for="email" class="text-capitalize ">E-mail:</label>
<br/>
<input type="email" placeholder="Enter Your E-mail" class="form-control text-light" name="email" required autofocus/>
<br/>

<label for="homeAddress" class="text-capitalize ">Home-Address:</label>
<br/>
<input type="text" placeholder="Enter Your Home-Address" class="form-control text-light" name="homeAddress" required/>
<br/>

<label for="phoneNumber" class="text-capitalize ">Phone-Number</label>
<br/>
<input type="number" placeholder="Enter Your Phone-Number" class="form-control text-light" name="phoneNumber" required/>
<br/>

<label for="birthday" class="text-capitalize ">Birthday:</label>
<br/>
<input type="date" placeholder="Update Your Birthdate" class="form-control text-light" name="birthday" required/>
<br/>

<h5 class="text-capitalize text-bold">Sex.</h5>
<input type="radio" value="male" class="d-inline radio-btn" name="gender" required/> <p class="text-capitalize d-inline ">male</p>
<br/>
<input type="radio" value="female" class="d-inline radio-btn" name="gender" required/> <p class="text-capitalize d-inline ">Female</p>

<br/>
<hr/>
<h5 for="profilePic" class="text-capitalize text-bold">profile picture</h5>
<br/>
<input type="file" value="profilePic" class="bg-dark p-2 text-light w-75 form-control-file border" name="profilePic" id="profilePic" required>
<br/>
<hr/>



<label for="comment" class="text-capitalize ">Let's know a little about you:</label>
<br/>
<textarea placeholder="write something" class="form-control text-capitalize bg-dark text-light" name="comment" required>
    </textarea>
<br/>
	<button class="btn btn-success form-control text-center text-capitalize" name="submit"> update profile</button>
<br/>
<br/>

<button class="btn btn-primary text-center text-capitalize m-auto"> <a href="index.php" class="text-capitalize text-light text-center text-decoration-none"> &lt;&lt; back to dashboard</a></button>
</form>

</div>
<br/>
<br/>

<?php

#import all the required modules
require_once "errorLog.php";
require_once "validateMethods.php";

#validation occurs here.

require_once "conn.php";

#validation occurs here.

if(isset($_POST["submit"]) and $_SERVER["REQUEST_METHOD"]==serverMethod){
	#the user has submitted the form
	#special validation has to be done on the email
	$email= mysqli_real_escape_string($conn,parse_inputs($_POST["email"]));
	$phoneNumber=mysqli_real_escape_string($conn,parse_inputs($_POST["phoneNumber"]));
	$homeAddress=mysqli_real_escape_string($conn,parse_inputs($_POST["homeAddress"]));
	$birthday=mysqli_real_escape_string($conn,parse_inputs($_POST["birthday"]));
	$comment=mysqli_real_escape_string($conn,parse_inputs($_POST["comment"]));
	$sex=mysqli_real_escape_string($conn,parse_inputs($_POST["gender"]));
	$profilePic=$_FILES["profilePic"];

	
	#reference the file upload folder
	$upload_dir= "profilePic/";
	#create a file size constant
	#this is 1mb
	$max_file_size=1000000;
	$profile_updated=0;

	


	if(!empty($email) and !empty($phoneNumber) and !empty($homeAddress) and !empty($birthday) and !empty($comment) and !empty($sex) and !empty($profilePic)){
		#all the user inputs are complete proceed with the validation
		#check if the user email is valid


		

		#validate the file submitted by the user
		$upload_file_name=$_FILES["profilePic"]["name"];
		#convert the uploaded file extension to lower case
		
		$striped_upload_file=explode('.',$upload_file_name);
		#create an array for the possible type of file allowed for upload
		$legit_file_extension=array("png","jpeg","jpg","gif");
		$legit_upload_file_ext=strtolower(end($striped_upload_file));
		#explode the file name to check for the extension
		
		$upload_tmp_name=$_FILES["profilePic"]["tmp_name"];
		$upload_file_error=$_FILES["profilePic"]["error"];
		$upload_file_size=$_FILES["profilePic"]["size"];
		#the file is not uploaded by default
		$file_match_success=false;

		#rename the file
		$randomNumber=rand(0,10000000);
		$randomTime=time();
		$processed_file_name=$randomNumber.$randomTime.'.'.$legit_upload_file_ext;
		$target_file_dir=$upload_dir.$processed_file_name;
		#check if there was an error uploading the file
		if($upload_file_error != 0){
			unknown_file_error();
		}else{

			#check if the uploaded file is above the legit file size
			if($upload_file_size > $max_file_size){
				large_uploaded_file();
			}else{

				#check if the uploaded file matches the legit file extension
				if(in_array($legit_upload_file_ext,$legit_file_extension)){
					#the file matches all the required properties
					$file_match_success=true;

				
				
				}else{
					wrong_file_extension();
					
				}
			}

		}

	

		#check if the email is legit
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			#throw an error to the user
			invalid_email();
		}



		#make connection with the database

		#get the user's username and password and the input it into another table;
		#check if there is a failure in the connection
		if(!$conn){
			#unknown error occured 
			#unknown_error_msg();
			die("unknown error occured during the process of connecting");
		}else{
			#prepare the query
			$ID=$row["ID"];
			$query="SELECT * FROM users WHERE ID ='$ID' ";
			$result=mysqli_query($conn,$query);
			$userRow=mysqli_fetch_assoc($result);
			$userName=$userRow["user_name"];
			$password=$userRow["password"];
			#check if the fetched results is legit
			if(mysqli_num_rows($result) > 0){		
				$query2="SELECT * FROM users WHERE ID ='$ID' AND  user_name ='$userName' AND password ='$password' ";
				$result2=mysqli_query($conn,$query2);
				$row2=mysqli_fetch_assoc($result2);
				#check if the username and the password is fetched
				if(mysqli_num_rows($result2) == 1){

					#insert the data into the users_info
				  $new_username=$row2["user_name"];
				  $new_password=$row["password"];

				  #change the profile update status
				  $profile_updated=1;
				  $date_time_updated=date("d/m/y")." - ".date("h:i:s:a");
				
				$profile_updated=1;
				
			    $newQuery="UPDATE users_info SET email ='$email', birthday ='$birthday', sex ='$sex', comment ='$comment', home_address ='$homeAddress', phone_number ='$phoneNumber', profile_picture ='$processed_file_name', time_updated ='$date_time_updated', user_name ='$userName', password ='$password', profile_updated='$profile_updated' WHERE U_ID = '$ID'";
				$newResult=mysqli_query($conn,$newQuery);
				#$newRow=mysqli_fetch_assoc($newResult);

				if(!$newResult){
					#unknown_error_msg();
					die("couldn't update the database ".mysqli_error($conn));
				}else{
					#check if the file upload process is true
					if($file_match_success==true){
						#move the picture to the folder on the server
						#check if there was an error
						if(move_uploaded_file($upload_tmp_name,$target_file_dir)){
							#file uploaded successfully
							#echo("upload success");
							profile_update_success();
							#delay the execution process by some seconds
							sleep(2);
							#profile updated becomes true, change it in the dbase
							echo '<script>
							    location.href="index.php";
							</script>';
						}else{
							
							#an error occured 
							unknown_file_error();
							#die("error occured during file upload in the".mysqli_error($conn));
						}
					}
				
				}

				
				
				}else{
					#profile not found on server
					#die("profile not found");
					profile_server_error();
				}
			}else{
					#profile not found on server
					#die("query one not performed");
					profile_server_error();
			}
		}

		
	}else{
		#the profile data are not complete
		incomplete_update_error();
	}
}
?>



</body>
</html>