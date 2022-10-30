
<?php
require "conn.php";

if(!empty($_SESSION["ID"])){
	#this means someone is logged in
	$ID=$_SESSION["ID"];
	$query="SELECT * FROM users WHERE ID = $ID";
	$result=mysqli_query($conn,$query);
	$row=mysqli_fetch_assoc($result); 

    $user_info_query="SELECT * FROM users_info WHERE U_ID = $ID";
    $user_query_result=mysqli_query($conn,$user_info_query);
    $user_info_row=mysqli_fetch_assoc($user_query_result);

 


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
<link rel="stylesheet" href="bootstrap.css">
<!-- <link rel="stylesheet" href="style.css"> -->

<script src="bootstrap.js"></script>
<script src="jquery.slim.min.js"></script>
<script src="sweetAlert2.js"></script>
<noscript>This application requires javaScript to run</noscript>
<link rel="stylesheet" href="msgConfig.css"/>
<title>Find Users</title>

<style>
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
.errorLog{
    display:none;
}

input[type=text],input[type=password],input[type=email],input[type=number],textarea  {
        color:white;

        }

    input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill:hover,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill:focus,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date]:-webkit-autofill:active{
          -webkit-box-shadow: 0 0 0 30px #343a40 inset !important;
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
    background: #121212;
   }





</style>
</head>
<body class="text-light">
<?php require_once "nav.php";?>
<br/>
<div class="d-flex align-items-center justify-content-around flex-column">
<div class="data-area w-100 text-capitalize "id="data-area">
    <div class="d-flex justify-content-center align-items-center p-1 profile_card ">
        <?php
         #$user_online_status=false;
         if($row["status"] == 1){
             echo ' <div class="rounded-circle status_online" ></div>';
             echo '<img src="profilePic/'.$user_info_row["profile_picture"].'"'.'height="50" width="50" class="rounded-circle alt="profile_pic" "';
         }else{
            echo ' <div class="rounded-circle status_offline" ></div>';
            echo '<img src="profilePic/'.$user_info_row["profile_picture"].'"'.'height="50" width="50" class="rounded-circle alt="profile_pic" "';
         }

            #create a variable to keep track of the search result
            $search_result_number=0;
        ?>
    <br/>
    <h3 class="text-capitalize text-center p-3" ><?php echo $row["user_name"]?></h3>
  
</div>
</div>
</div>

<br/>
<h3 class="text-capitalize p-2 text-center">search for an admin to chat with...</h3>
<br/>
<div class="errorLog rounded p-2 justify-content-center align-items-center text-center text-capitalize text-light flex-column" id="errorLog" style="background:tomato;"></div>
<div class="search_div">
 <form class="search-area m-auto p-4 d-flex justify-content-center align-items-center flex-column" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">

<input type="text" name="searchUsers" id="searchUsers" class="form-control w-75 text-light" placeholder="Search A User..."  autocomplete="on">
<br/>
<div class="form-group">
<select name="searchOrder" class="form-control bg-dark text-light">
  <option value="0" class="text-capitalize text-center">--Order of search--</option>
  <option value="1" class="text-capitalize text-center">all admin</option>
  <option value="2" class="text-capitalize text-center">old admin</option>
  <option value="3" class="text-capitalize text-center">active admin</option>
  <option value="4" class="text-capitalize text-center">newest admin</option>
</select>

<br/><br/>
    <input type="submit" value="Search Admin" class="btn btn-primary   form-control text-center" name="users_search">

    <br/>
<br/>
<h4 class="text-center text-capitalize p-3">view Users By filter search</h4>
<br/>
<select name="search_order_direct_query" class="form-control bg-dark text-light">
  <option value="0" class="text-capitalize text-center">--Order of search--</option>
  <option value="1" class="text-capitalize text-center">all admin</option>
  <option value="2" class="text-capitalize text-center">old admin</option>
  <option value="3" class="text-capitalize text-center">active admin</option>
  <option value="4" class="text-capitalize text-center">newest admin</option>
</select>

<br/>
    <input type="submit" value="Search Admin" class="btn btn-primary form-control text-center" name="submit_direct_query">
    <br/>

</div>

</div>

<div class="search d-flex align-items-center justify-content-center">
<br/><br/><br/><br/>
    <button class="btn btn-dark"><a href="index.php" class="text-decoration-none text-light text-capitalize">&lt;&lt; back to dashboard </a></button>
</div>
<br/>

<h4 class="text-capitalize text-center  " id="totalSearchResult">Total Search Result: 0</h4>
<br/>
</form>

<?php

#import all the required modules
require_once "errorLog.php";
require_once "validateMethods.php";

require_once "conn.php";

#check if the user made a direct query
if(isset($_POST["submit_direct_query"]) AND $_SERVER["REQUEST_METHOD"] == serverMethod){
    $select_query="";
    $default_status=1;
    #get the selected value of the select item
    #check if the select item is empty
    $user_selected_item=mysqli_real_escape_string($conn,htmlspecialchars(parse_inputs($_POST["search_order_direct_query"])));

    if(!empty($user_selected_item)){
       #check the type of request the user is tying to make
        switch ($user_selected_item) {
             # "0" => default "1" => all users "2" => old users  "3"=>active users 4" => newest users
            case '0':
                # code...
                    echo '<script>
                    swal.fire({

                        title:"Error",
                        text:"Abeg, select a legit option",
                        icon:"warning"
                    });



                </script>';
                    search_order_empty();
                break;
             case '1':
                # get all the users from the dbase
             $select_query="SELECT * FROM admin_info ";

                break;

             case '2':
                # get all the old users from the dbase
             $select_query="SELECT * FROM admin_info  ORDER BY A_ID ASC";
                break;

             case '3':
                #get all the active users from the dbase
             $select_query="SELECT * FROM admin_info WHERE status ='$default_status'";
                break;

             case '4':
            # get all the new users from the dbase
             $select_query="SELECT * FROM admin_info ORDER BY A_ID DESC";
                 break;
            default:
                # search order is empty
                    echo '<script>
                    swal.fire({

                        title:"Error",
                        text:"Abeg, select a legit option",
                        icon:"warning"
                    });



                </script>';
                 search_order_empty();
                break;
        }

         #check if something went wrong with the connection
            if(!$conn){
                unknown_error_msg();
            }

            $search_array=array();
            $user_default_status="offline";
            $search_user_status="";

            #process the query
            $get_users_result=mysqli_query($conn,$select_query);

            if(!$get_users_result){
                unknown_error_msg();
                die("An error occured".mysqli_error($conn));
            }else{

                if(mysqli_num_rows($get_users_result) > 0){
                while($user_search_row=mysqli_fetch_assoc($get_users_result)){
                    $search_result_number++;
                    array_push($search_array,$search_result_number);
                    
                    ($user_search_row["status"] == 1) ? $user_default_status="online" : $user_default_status="offline";
                    echo '<script>
                    
                    //use the id to inesrt the current search data with php
                    totalSearchResult.innerHTML="Total Search Result: '.count($search_array).'"
                    </script>';
                    
                    $final_search_result2= $search_result_number.'
                    <a href="messageAdmin.php?chat_admin_receiver_id='.htmlspecialchars($user_search_row["A_ID"]).'"title="View '.$user_search_row["user_name"].' Profile" class="d-block text-decoration-none" autofocus style="border:none; outline:none; ::selection{border:none; outline:none;}">
                    <div class=" container" >
                    <div class="user_info bg-dark rounded-3 m-auto pt-2 search-data">

                    <p class="text-capitalize text-light p-2 profile_status" id="profile_status">Status: '.$user_default_status.'</p>

                    <h4 class="text-capitalize m-auto p-3 text-light">'.$user_search_row["user_name"].'</h4>
                    <div class="p-3 d-flex text-center flex-row-reverse align-items-end justify-content-around flex-wrap"> 
                    
                    <img src="profilePic/'.$user_search_row["profile_picture"].'" width="50" height="50" class="rounded-circle  ">
                    
                    
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

                            title:"Error",
                            text:"Server returned 0 result",
                            icon:"warning"
                        });



                    </script>';
                    search_result_empty();
                }




            }
    }else{

        echo '<script>
            swal.fire({

                title:"Error",
                text:"Abeg, select a legit option",
                icon:"warning"
            });



        </script>';
        die();
       // die('<h3 class="text-danger text-capitalize text-center">*Search Item Must Not Be Empty*</h3>');
    }

}

if(isset($_POST["users_search"]) and $_SERVER["REQUEST_METHOD"] ==serverMethod){
    $user_search_input=mysqli_real_escape_string($conn,parse_inputs($_POST["searchUsers"]));
    $user_search_order=mysqli_real_escape_string($conn,parse_inputs($_POST["searchOrder"]));

    # "0" => default "1" => all users "2" => old users  "3"=>active users 4" => newest users
    if(!empty($user_search_input)){
        #check if the order of the input was left to default
        if(empty($user_search_order) or $user_search_order == 0){

                echo '<script>
                swal.fire({

                    title:"Error",
                    text:"Abeg, select a legit option",
                    icon:"warning"
                });



            </script>';
            search_order_empty();

        }else{
           #here, prepare the search query pending on the type of search order
           #user search query
           $user_search_query=""; 
           $user_query_append="";
           switch ($user_search_order) {
                case '0':
                    # code...

                    echo '<script>
                    swal.fire({

                        title:"Error",
                        text:"Abeg, select a legit option",
                        icon:"warning"
                    });



                    </script>';
                    search_order_empty();   
                        # code...
                    break;
                case '1':

                    
                    # order 1=> all users
                    $user_search_query="SELECT * FROM admin_info ";
                    $user_query_append="WHERE user_name LIKE '%$user_search_input%'";

                    break;
                case '2':
                    
                    #order 2=> old users
                    $user_search_query="SELECT * FROM admin_info ";
                    $user_query_append="WHERE user_name LIKE '%$user_search_input%' ORDER BY A_ID ASC";
                    # code...
                    break;
                case '3':
        
                    #order 3=> active users
                    $user_search_query="SELECT * FROM admin_info ";
                    $user_query_append="WHERE user_name LIKE '%$user_search_input%' AND status =1 ";
                    # code...
                    break;
                case '4':
                  
                    #order 4=> newest users
                    $user_search_query="SELECT * FROM admin_info ";
                    $user_query_append="WHERE user_name LIKE '%$user_search_input%' ORDER BY A_ID DESC ";
                    # code...
                    break;
                                        
                
                default:

                    echo '<script>
                    swal.fire({

                        title:"Error",
                        text:"Abeg, select a legit option",
                        icon:"warning"
                    });



                    </script>';
                    search_order_empty();
                    # code...
                    break;
            }
            #check if something went wrong with the connection
            if(!$conn){
                unknown_error_msg();
            }
            #run the query based on the user input
            $user_search_result=mysqli_query($conn,$user_search_query.$user_query_append);
            $search_array=array();
            $user_default_status="offline";
            $search_user_status="";
            
            if(!$user_search_result){
                die("An error occured".mysqli_error($conn));
            }
                 while($user_search_row=mysqli_fetch_assoc($user_search_result)){
                    $search_result_number++;
                    array_push($search_array,$search_result_number);
                    
                    ($user_search_row["status"] == 1) ? $user_default_status="online" : $user_default_status="offline";
                    echo '<script>
                    
                    //use the id to inesrt the current search data with php
                    totalSearchResult.innerHTML="Total Search Result: '.count($search_array).'"
                    </script>';
                    
                    $final_search_result2= $search_result_number.'
                    <a href="messageAdmin.php?chat_admin_receiver_id='.htmlspecialchars($user_search_row["A_ID"]).'"title="View '.$user_search_row["user_name"].' Profile" class="d-block text-decoration-none" autofocus style="border:none; outline:none; ::selection{border:none; outline:none;}">
                    <div class=" container " >
                    <div class="user_info bg-dark rounded-3 m-auto pt-2 search-data">

                    <p class="text-capitalize text-light p-2 profile_status" id="profile_status">Status: '.$user_default_status.'</p>

                    <h4 class="text-capitalize m-auto p-3 text-light">'.$user_search_row["user_name"].'</h4>
                    <div class="p-3 d-flex text-center flex-row-reverse align-items-end justify-content-around flex-wrap"> 
                    
                    <img src="profilePic/'.$user_search_row["profile_picture"].'" width="50" height="50" class="rounded-circle  ">
                    
                    
                    <p class="text-capitalize text-center d-flex align-items-center justify-content-center text-light">Bio: ' .$user_search_row["comment"].'</p>
                    </div>

                    </div>
                    </div>


                    <br/><br/>
                    </a>
                    ';

                    echo $final_search_result2;
                  
                    
                } if(mysqli_num_rows($user_query_result) > 0){
           
            }else{
                search_result_empty();
            }

          
               
            

        
            
        }
    }else{
        #throw an error message to the user

        echo '<script>
        swal.fire({

            title:"Error",
            text:"Abeg, select a legit option",
            icon:"warning"
        });



        </script>';
        search_input_empty();
    }

}

?>
<br/><br/>


<?php require_once "footer.php";?>
</body>
</html>
