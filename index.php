<?php
require "conn.php";   

if(!empty($_SESSION["ID"])){
	#this means someone is logged in
	$ID=$_SESSION["ID"];
	$query="SELECT * FROM users WHERE ID = $ID";
	$result=@mysqli_query($conn,$query);
	$row=@mysqli_fetch_assoc($result);

    $user_info_query="SELECT * FROM users_info WHERE U_ID = $ID";
    $user_query_result=@mysqli_query($conn,$user_info_query);
    $user_info_row=@mysqli_fetch_assoc($user_query_result);


    if(!$conn){
        die("<h4 class='text-danger text-center text-capitalize '>an error occured, connection lost!</h4>");
    }
}else{
	echo '<script>location.href="homePage.php"</script>';
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

<script src="bootstrap.js"></script>
<script src="jquery.js"></script>
<script src="sweetAlert2.js"></script>
<script src="userPageNav.js"></script>
<script src="typingEffect.js"></script>

<link rel="stylesheet" href="msgConfig.css">

<title>Dashboard</title>

<style>

  body{
    background: #121212;
    color:white;
  }

  ::-webkit-scrollbar{
    width:5px;
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

   .sidenav::-webkit-scrollbar{
    width:5px;
    height:5px;
    background:#121212;

  }

  .sidenav::-webkit-scrollbar-thumb{
    border-radius:20px;
    opacity:.7;
    background:dodgerblue;
    width:2px;
  }

   .sidenav::-webkit-scrollbar-button{
    display:none;
   }

   .sidenav::-webkit-scrollbar-corner{
    display: none;
   }



.dashboard{
    
    height:100%;
    background:#121212;
    position:absolute;
    left:0;
    top:;
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

input:active,input:hover{
 
     -webkit-box-shadow: 0 0 0 30px #121212 inset !important;
          color:white;
          border:none;
}


    input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill:hover,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill:focus,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date]:-webkit-autofill:active{
          -webkit-box-shadow: 0 0 0 30px #121212 inset !important;
          color:white;
          border:none;  
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




.d-btn{
  background:#121212;
  border-color:white;
  color:black;

}

</style>
</head>
<body class="text-light">
<div class="container-fluid p-0 text-light">

<?php require_once "nav.php";?>
<div class="d-flex align-items-center justify-content-around flex-row-reverse ">
<div class="data-area w-100 text-capitalize "id="data-area">
    <div class="d-flex justify-content-center align-items-center p-4">
        <?php
         #$user_online_status=false;
         if($row["status"] == 1){
            
             echo '<img src="profilePic/'.$user_info_row["profile_picture"].'"'.'height="50" width="50" class="rounded-circle alt="profile_pic" "';
         }else{
            
            echo '<img src="profilePic/'.$user_info_row["profile_picture"].'"'.'height="50" width="50" class="rounded-circle alt="profile_pic" "';
         }
        ?>
    <br/>
    <h2 class="text-capitalize text-center p-3" >welcome <?php echo $row["user_name"]?></h2>
</div>
  <?php
  #check if the user has updated his/her profile or not
  $user_update_profile_query="SELECT * FROM users_info WHERE U_ID = $ID";
  $user_update_profile_result=mysqli_query($conn,$user_update_profile_query);
  $user_update_profile_row=mysqli_fetch_assoc($user_update_profile_result);

  #check if the query was successful
  if(!$user_update_profile_result){
      echo "an unknown error occured";
  }else{
      if(mysqli_num_rows($user_update_profile_result) > 0){
        #the query was successful and there is a record in the dbase
        #check if the user has updated the profile
        if($user_update_profile_row["profile_updated"] == 1){
              echo "<p class='p-2'>Welcome Back ". $row["user_name"].", you updated your profile details on... ". $user_update_profile_row["time_updated"].", you can always change your profile details</p>";
              echo '
                <br/><br/>
               <!-- <button class="btn btn-primary text-center text-capitalize"> <a href="changeProfile.php" class="text-decoration-none text-center text-light">change profile details &gt;&gt;</a> </button>
                -->';


               /*

                here we get all the data from the database to populate the live users' s news feed


               */

                $get_active_users_query="SELECT * FROM users WHERE status = '1' ";
                $get_active_users_result=@mysqli_query($conn,$get_active_users_query);


                #check if the query was successful
                if(!$get_active_users_result){
                    echo '<script>
                        $(document).ready(()=>{
                          const $active_users_text=$("#active_users_number");
                              $active_users_text.removeClass("text-light");
                              $active_users_text.addClass("text-danger");
                              $active_users_text.text("0");

                        });
                    </script>';
                    die();
                }else{
                    #get the total active users
                    $total_active_users=mysqli_num_rows($get_active_users_result);

                    echo '<script>
                         $(document).ready(()=>{
                          const $active_users_text=$("#active_users_number");
                              $active_users_text.text('.$total_active_users.');

                        });
                    </script>';
                }


                /*

                    @data => Get the total users on test-base

                */


                $get_all_users_query="SELECT * FROM users";
                $get_all_users_result=@mysqli_query($conn,$get_all_users_query);


                #check if the query was successful
                if(!$get_all_users_result){
                    echo '<script>
                        $(document).ready(()=>{
                          const $active_users_text=$("#all_users_number");
                              $all_users_text.removeClass("text-light");
                              $all_users_text.addClass("text-danger");
                              $all_users_text.text("0");

                        });
                    </script>';
                    die();
                }else{
                    #get the total  users
                    $total_users=mysqli_num_rows($get_all_users_result);

                    echo '<script>
                         $(document).ready(()=>{
                          const $all_users_text=$("#all_users_number");
                              $all_users_text.text('.$total_users.');

                        });
                    </script>';
                }






                /*

                    @data => Get the total admin on test-base

                */


                $get_all_admin_query="SELECT * FROM admin";
                $get_all_admin_result=@mysqli_query($conn,$get_all_admin_query);


                #check if the query was successful
                if(!$get_all_admin_result){
                    echo '<script>
                        $(document).ready(()=>{
                          const $active_admin_text=$("#all_admin_number");
                              $all_admin_text.removeClass("text-light");
                              $all_admin_text.addClass("text-danger");
                              $all_admin_text.text("0");

                        });
                    </script>';
                    die();
                }else{
                    #get the total admin
                    $total_admin=mysqli_num_rows($get_all_admin_result);

                    echo '<script>
                         $(document).ready(()=>{
                          const $all_admin_text=$("#all_admin_number");
                              $all_admin_text.text('.$total_admin.');

                        });
                    </script>';
                }
          $html_template='

            <section class="m-auto">


            <h5 class="text-capitalize text-sm-center text-md-center p-2 text-bold">are you new here?</h5>

            <p class="p-2">
            On this platform, you can <a href="findUsers.php" class="text-capitalize text-decoration-none text-primary" >find other users</a>, relate, <a class="text-capitalize text-decoration-none text-danger" href="showUsers.php">chat</a> and get to know each other better, to know know more, you can also take a <i>tour</i> to get familiar with <strong class="text-primary">Test-Base</strong>
            </p>

            <button class="btn btn-primary text-capitalize text-light d-sm-block d-md-none m-auto" id="take_a_tour">Take a tour</button> </section>
            <br/>
          <!--  <button id="test_base" class="btn btn-secondary text-capitalize text-light d-sm-none d-md-block my-2 p-2 m-auto">About Test_Base</button>

            -->

              <br/>
              <input type="text" name="testBaseInfo" id="testBaseInfo" class="text-capitalize text-light bg-dark text-bold m-auto text-center" style="border:none outline:none"/>
              
              
           


              <div class="notify d-flex text-capitalize justify-content-evenly align-items-center flex-wrap mt-3 ">

                  <!-- notify bar 1-->
                  <div class="notify_bar  bg-dark text-light p-3  rounded-3 shadow mt-2 me-2 my-2" id="active_users">
                  <p class="notify text-capitalize">Active users</p>
                  <br/>
                  <h4 class="text-light" id="active_users_number"></h4>
                  </div>

                    
                    


                  <!-- notify bar 2 -->
                  <div class="notify_bar  bg-dark text-light p-3  rounded-3 shadow mt-2 me-2 my-2" id="total_users">
                  <p class="notify text-capitalize">Total Users</p>
                  <br/>
                  <h4 class="text-light" id="all_users_number"></h4>
                  </div>

                    

                  <!-- notify bar 3 -->
                  <div class="notify_bar  bg-dark text-light p-3  rounded-3 shadow mt-2 me-2 my-2" id="notifications">
                  <p class="notify text-capitalize">notifications </p>
                  <br/>
                  <h4 class="text-light">7</h4>
                  </div>


                  <!-- notify bar 4 -->
                  <div class="notify_bar  bg-dark text-light p-3  rounded-3 shadow mt-2 me-2 my-2" id="total_admin">
                  <p class="notify text-capitalize">Total admin</p>
                  <br/>
                  <h4 class="text-light" id="all_admin_number"></h4>
                  </div>


                  <!-- notify bar 5 -->
                  <div class="notify_bar  bg-dark text-light p-3  rounded-3 shadow mt-2 me-2 my-2" id="msg_request">
                  <p class="notify text-capitalize">msg request</p>
                  <br/>
                  <h4 class="text-light">7</h4>
                  </div>


                  <!-- notify bar 6 -->
                  <div class="notify_bar  bg-dark text-light p-3  rounded-3 shadow mt-2 me-2 my-2" id="total_exams">
                  <p class="notify text-capitalize">total exams</p>
                  <br/>
                  <h4 class="text-light">7</h4>
                  </div>



                  <!-- notify bar 7 -->
                  <div class="notify_bar  bg-dark text-light p-3  rounded-3 shadow mt-2 me-2 my-2" id="total_subject">
                  <p class="notify text-capitalize">user subjects</p>
                  <br/>
                  <h4 class="text-light">7</h4>
                  </div>


              


                  <!-- notify bar 8 -->
                  <div class="notify_bar  bg-dark text-light p-3  rounded-3 shadow mt-2 me-2 my-2" id="total_tests">
                  <p class="notify text-capitalize px-2"> total tests</p>
                  <br/>
                  <h4 class="text-light">7</h4>
                  </div>


              </div>

          ';

          echo $html_template;
        }else{
            echo $row["user_name"].", you have not updated your profile please click the button below to update your profile";
            echo '
            <br/><br/>
            <button class="btn btn-primary text-center text-capitalize"> <a href="updateProfile.php" class="text-decoration-none text-center text-light">update profile &gt;&gt;</a> </button>
            ';
        }
      }else{
        echo $row["user_name"].", you have not updated your profile please click the button below to update your profile";
            echo '
            <br/><br/>
            <button class="btn btn-primary text-center text-capitalize"> <a href="updateProfile.php" class="text-decoration-none text-center text-light">update profile &gt;&gt;</a> </button>
            ';
      }
  }
  



?>
</div>
<br/>
    <!-- vertical navigator also known as dashboard -->
</div>

</div>
<!-- data area -->

</div>


<script>
  

  $(document).ready(()=>{
      $("#take_a_tour").click(()=>{
          openNav();
      });

      $("#test_base").click(()=>{
          location.href="homePage.php";
      });


    const news_feed_header=document.getElementById('testBaseInfo');
    /*
        create a new instance of the typing effect
    */
    const header_typing_effect=new TypingEffect("know what's up ",news_feed_header,300,0);
    header_typing_effect.updateText();

    //do a lil bit of styling
    news_feed_header.style.border="none";
    news_feed_header.style.borderColor="#121212";
    news_feed_header.style.fontSize="1.21rem";
    news_feed_header.style.fontWeight="500";


  });

</script>
<script src="notifyEvents.js"></script>
<noscript>This application requires javaScript to run</noscript>
</body>
</html>
