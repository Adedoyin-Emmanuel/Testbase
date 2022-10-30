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

<link rel="stylesheet" type="text/css" href="../msgConfig.css"/>

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
<title>Manage Users</title>
</head>
<?php require_once "adminNav.php";?>
<body class="text-light">

<div class="container m-auto">
<br/>
<br/>
<br/>
<h3 class="text-capitalize text-center ">search,manage,message users </h3>

<section class="text-capitalize text-center">
    
    you can search for other users by searching their individual names of just view all users.
</section>
<div class="d-flex justify-content-center align-items-center p-4">
   
        <br/>

</div>


<h4 class="text-capitalize text">manage users</h4>

<div class="search_users bg-dark text-light rounded-3 p-5 shadow-lg">
    <h5 class="users_search text-capitalize text-center">start viewing users</h5>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <br/>
<div class="errorLog rounded p-2 justify-content-center align-items-center text-center text-capitalize text-light" id="errorLog" style="background:tomato;">error log baby</div>

<br/>

<!-- search button and search div  -->
<!-- <div class="d-flex align-items-end justify-content-between">
   -->  
<input type="text" name="search_users" id="serarch_users" placeholder="Type a username to search..." class="form-control m-auto my-4 bg-dark text-light">

<input type="submit" class="form-control btn btn-danger m-auto my-4  text-capitalize " name="btn_search" value="Proceed To Search User">
<!-- </div> -->

<!-- select and search users button -->
<br/>
<br/>

<select name="searchOrder" class="form-control bg-dark text-light my-4">
  <option value="0" class="text-capitalize text-center">--Order of search--</option>
  <option value="1" class="text-capitalize text-center">all users</option>
  <option value="2" class="text-capitalize text-center">old users</option>
  <option value="3" class="text-capitalize text-center">active users</option>
  <option value="4" class="text-capitalize text-center">newest users</option>
</select>
<input type="submit" class="form-control btn btn-danger  m-auto text-capitalize" name="btn_search_opt" value="proceed to search user">

<br/>


<button class="text-center text-capitalize btn btn-secondary my-3 m-auto"> <a href="index.php" class="text-decoration-none text-light text-center m-auto">Back To Dashboard</a></button>
</div>
<br/>

<h4 class="text-capitalize text-center  " id="totalSearchResult">Total Search Result: 0</h4>
</form>
</div>



</div>

<!-- validation -->

<?php

require_once "../errorLog.php";
require_once "../validateMethods.php";


#check if the button was clicked and what type of button was clicked

if(isset($_POST["btn_search_opt"]) AND $_SERVER["REQUEST_METHOD"] == serverMethod){
    #get the user input
    $search_method=mysqli_real_escape_string($conn,parse_inputs($_POST["searchOrder"]));
    $search_query=" ";
    $user_status=1;
    $user_default_status="offline";


    if(!empty($search_method)){
        # 1=> all users 2=> old users 3=>active users 4=>newest users
        switch ($search_method) {
            case '0':
                echo '<script>

                    swal.fire({
                    text:"Abeg select a legit option",
                    icon:"error",
                    timer:5000,
                    allowOutsideClick:false
                    });
    
                 </script>';
            die();
                break;
            case '1':

                $search_query="SELECT * FROM users_info";
                break;

            case '2':

                $search_query="SELECT * FROM users_info ORDER BY U_ID ASC";
                break;
            case '3':

                $search_query="SELECT * FROM users_info WHERE status ='$user_status'";
                break;
            case '4':
                $search_query="SELECT * FROM users_info ORDER BY U_ID DESC";

                 break;

            

            default:
                    echo '<script>

                    swal.fire({
                    text:"Abeg select a legit option",
                    icon:"error",
                    timer:5000,
                    allowOutsideClick:false
                    });

                </script>';
                die();
                break;
        }

        $search_query_result=mysqli_query($conn,$search_query);

        #check if the connection went wrong 
        if(!$conn){
            echo '<script>

            swal.fire({
            text:"An error occured while connecting to database",
            icon:"error",
            timer:5000,
            allowOutsideClick:false
            });

        </script>';
       die();
        }
        #check if the query went well
        if(!$search_query_result){
            echo '<script>

            swal.fire({
            text:"An error occured while fetching information from the database",
            icon:"error",
            timer:5000,
            allowOutsideClick:false
            });

        </script>';
        die();
        }else{
            $search_result_number=0;
            $search_array=array();


            if(mysqli_num_rows($search_query_result) > 0){

                while($user_search_row=mysqli_fetch_assoc($search_query_result)){
                    $search_result_number++;
                    array_push($search_array,$search_result_number);
                    ($user_search_row["status"] == 1) ? $user_default_status="online" : $user_default_status="offline";

                    echo '<script>
                    
                    //use the id to inesrt the current search data with php
                    totalSearchResult.innerHTML="Total Search Result: '.count($search_array).'"
                    </script>';

                    $final_search_result2= $search_result_number.'
                    <a href="adminViewUsersProfile.php?ID='.htmlspecialchars($user_search_row["U_ID"]).'"title="View '.$user_search_row["user_name"].' Profile" class="d-block text-decoration-none" style="border:none; outline:none; ::selection{border:none; outline:none;}" autofocus>
                    <div class=" container " >
                    <div class="user_info bg-danger shadow-lg text-light rounded-3 m-auto pt-2 search-data">

                    <p class="text-capitalize text-light p-2 profile_status" id="profile_status">Status: '.$user_default_status.'</p>

                    <h4 class="text-capitalize m-auto p-3 text-light">'.$user_search_row["user_name"].'</h4>
                    <div class="p-3 d-flex text-center flex-row-reverse align-items-end justify-content-around"> 
                    
                    <img src="../profilePic/'.$user_search_row["profile_picture"].'" width="50" height="50" class="rounded-circle  ">
                    
                    
                    <p class="text-capitalize text-center d-flex align-items-center justify-content-center text-light">Bio: ' .$user_search_row["comment"].'</p>
                    </div>

                    </div>
                    </div>


                    <br/><br/>
                    </a>
                    ';

                    echo $final_search_result2;
                }
            }else{
                 echo '<script>

                    swal.fire({
                    text:"No search result found",
                    icon:"error",
                    timer:5000,
                    allowOutsideClick:false
                    });

                </script>';
                search_result_empty();
                die();
            }

        }

    }else{
        echo '<script>

            swal.fire({
            text:"Abeg select a legit option",
            icon:"error",
            timer:5000,
            allowOutsideClick:false
            });

        </script>';
        die();

    }

  



       
}



#check if the second search button was clicked 


if(isset($_POST["btn_search"]) AND $_SERVER["REQUEST_METHOD"] ==serverMethod){
    #get the name the user typed
    $user_name_search=mysqli_real_escape_string($conn,parse_inputs($_POST["search_users"]));

    
    if(empty($user_name_search)){
        echo '<script>

        swal.fire({
        text:"Abeg select a legit option",
        icon:"error",
        timer:5000,
        allowOutsideClick:false
        });

    </script>';
    die();

    }else{
  
    #prepare the query based on the admin's search

    $get_user_query="SELECT * FROM users_info WHERE user_name LIKE '%$user_name_search%'";
    $get_user_result=mysqli_query($conn,$get_user_query);

    
        #check if the query went well
    if(!$get_user_result){
        echo '<script>

        swal.fire({
        text:"An error occured while fetching information from the database",
        icon:"error",
        timer:5000,
        allowOutsideClick:false
        });

    </script>';
    die();
    }else{
        $search_result_number=0;
        $search_array=array();

        if(mysqli_num_rows($get_user_result) > 0){
            while($user_search_row=mysqli_fetch_assoc($get_user_result)){
                $search_result_number++;
                array_push($search_array,$search_result_number);
                ($user_search_row["status"] == 1) ? $user_default_status="online" : $user_default_status="offline";

                echo '<script>
                
                //use the id to inesrt the current search data with php
                totalSearchResult.innerHTML="Total Search Result: '.count($search_array).'"
                </script>';

                $final_search_result2= $search_result_number.'
                <a href="adminViewUsersProfile.php?ID='.htmlspecialchars($user_search_row["U_ID"]).'"title="View '.$user_search_row["user_name"].' Profile" class="d-block text-decoration-none" style="border:none; outline:none; ::selection{border:none; outline:none;}" autofocus>
                <div class=" container " >
                <div class="user_info bg-danger shadow-lg text-light rounded-3 m-auto pt-2 search-data">

                <p class="text-capitalize text-light p-2 profile_status" id="profile_status">Status: '.$user_default_status.'</p>

                <h4 class="text-capitalize m-auto p-3 text-light">'.$user_search_row["user_name"].'</h4>
                <div class="p-3 d-flex text-center flex-row-reverse align-items-end justify-content-around"> 
                
                <img src="../profilePic/'.$user_search_row["profile_picture"].'" width="50" height="50" class="rounded-circle  ">
                
                
                <p class="text-capitalize text-center d-flex align-items-center justify-content-center text-light">Bio: ' .$user_search_row["comment"].'</p>
                </div>

                </div>
                </div>


                <br/><br/>
                </a>
                ';

                echo $final_search_result2;
            }
        }else{
            echo '<script>

            swal.fire({
            text:"No search result found",
            icon:"error",
            timer:5000,
            allowOutsideClick:false
            });

             </script>';
        search_result_empty();
        die();
        }
    }
        

    }

}

?>
</body>
<script src="adminPageNav.js"></script>
</html>