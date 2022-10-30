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

<?php
extract($_GET);


if(isset($receiver_id)){
   $_SESSION["admin_receiver_id"] = $receiver_id;
   echo '<script>
    location.href="adminMessageUser.php";
   </script>';

}

if(!isset($_SESSION["admin_receiver_id"])){
  echo '<script>
   location.href="adminShowUsers.php";
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
<link rel="stylesheet" href="adminPageNav.css">

<script src="../bootstrap.js"></script>
<script src="../jquery.slim.min.js"></script>
<script src="../sweetAlert2.js"></script>
<script src="adminGetUsersStatus.js"></script>
<link rel="stylesheet" type="text/css" href="../msgConfig.css"/>

<style>
    .rounded-circle{
        transform:translate(60px,40px);
     
    }

    .image{
        transform:translate(-50px,-5px);
    }

    #time_sent{
      float:right;
      font-size:14px;
      text-shadow: 1px 1px 1px black;
    }

   

    .rounded_img{
        border-radius:50%;
    }

    body{
      background: lightblue;
    }

    .you{
      
      text-shadow:1px 1px 1px black;
    }

     ::-webkit-scrollbar{
    width:5px;
    background:#121212;

  }

  ::-webkit-scrollbar-thumb{
    border-radius:20px;
    opacity:.7;
    background:dodgerblue;
    width:5px;
    height:5px;
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


input[type=text],input[type=password],input[type=email],input[type=number],textarea  {
        color:white;

    }

    input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill:hover,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill:focus,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date]:-webkit-autofill:active{
          -webkit-box-shadow: 0 0 0 30px #343a40 inset !important;
    }

    


    .notify_icon{
       height:25px;
       width:25px;  
       font-size:14px;
       text-shadow:1px 1px 1px black;
       transform:translateY(-10px);
       display:flex;
       justify-content:center;
       align-items:center;
      
    }

    .status_online{
  width:15px;
  height:15px;
  outline:2px solid white;
  background:green;
 transform:translate(95px,55px);
 z-index: 100;


    
  
}


.status_offline{
  width:15px;
  height:15px;
  outline:2px solid white;
  background:grey;
  transform:translate(57px,-8px);
  
}

.errorLog{
    font-size:16px;
    display:none;
            
}
    
</style>
<title>
Admin Message Users
</title>
</head>
<body class="text-light">

  <script>
    
    $(document).ready(($)=>{
        $("#focusElement").focus();
    });

  </script>
<div class="container-fluid p-0 m-auto text-capitalize bg-mute">
  <?php require_once "adminNav.php";?>
    <section class="text-capitalize p-4 m-auto">
  <br/><br/>
<?php


#get the use information from the dbase using the query string
$get_user_info="SELECT * FROM users_info WHERE U_ID ='$_SESSION[admin_receiver_id]'";
$get_user_info_result=mysqli_query($conn,$get_user_info);

$default_status="offline";


if(!$get_user_info_result){
    echo '<script>
    swal.fire({
        title:"Error",
        text:"couldn`t retrive some data from the database",
        icon:"error"

    });

</script>';
die("error occured".mysqli_error($conn));
}else{

    if(mysqli_num_rows($get_user_info_result) > 0){
        $u_info_row=mysqli_fetch_array($get_user_info_result);

        if($u_info_row["status"] == 1){
          $default_status="online";
        }else{
          $default_status="offline";
        }

      
    }else{
        echo "An error occured, server returned 0 results";
        echo '<script>
    swal.fire({
        title:"Error",
        text:"An error occured, server returned 0 results",
        icon:"warning"

    });

    </script>';
        die();
    }
}







?>

<h5 class="text-capitalize text-center m-auto"><?php echo $admin_info_row["user_name"]."'s"?>  Chat With <?php echo $u_info_row["user_name"]?></h5>

<!--     <h2 class="text-capitalize text-center p-3" >welcome <?php echo $user_info_row["user_name"]?></h2> -->
    <br/>
    


</section>





<div class="container d-flex justify-content-around align-items-start flex-column text-capitalize">

<div class="container d-flex justify-content-around align-items-start flex-column text-capitalize">

     <div class="bg-white p-1 text-center rounded shadow-lg my-2" id="element" style="cursor:pointer" title="scroll to bottom 😋 ">
    
    <img src="../images/arrow_down_2.png" height="20" width="20" alt="down_scroll_button"/>
</div>
<div class="user_info d-flex align-items-center justify-content-between flex-row-reverse w-100 bg-dark text-light p-4 pe-3 rounded ">

<img src="<?php echo '../profilePic/'.$u_info_row['profile_picture']?>" height="40" width="40" alt="profile_picture" class="rounded-circle image"/>

<p class="text-center text-capitalize" id="getUserStatus"></p>
</div>
<br/>
<form class="form d-flex flex-column w-100 jutify-items-start align-items-start" method="POST" action="" id="msgForm">
<div class="message_div d-flex w-100 justify-content-around align-items-start flex-column">
    <div class="errorLog rounded p-2 justify-content-center align-items-center text-center text-light w-75 m-auto pb-3" id="errorLog"  style="background:tomato;"> no messages avaliable</div>
    <br/>

<script>
  


$(document).ready(()=>{
  setInterval(()=>{
    let receiver_id=$("#receiver").val();
    //get the necessary id's with  ajax
    var xhttp=new XMLHttpRequest() ||  new ActiveXObject("Microsoft.XMLHTTP");
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
             
             $("#data_div").html(this.responseText);
           
          }
    };
    xhttp.open("GET","adminShowMessages.php",true);
    xhttp.send();

    
  },100)
});
</script>

<div id="data_div" class="m-auto w-100">
  
<!-- here, the msg are placed automatically by AJAX -->

</div>
<br/>
<br/>
<br/>

</div>
<input type="text" name="receiver" id="receiver" hidden value="<?php echo $_SESSION['admin_receiver_id']?>">
<input type="text" name="user_msg" id="sending" class="form-control p-2 w-75 m-auto text-light" placeholder="Type A Message..." resize  required autocomplete="off" autofocus>

<br/><br/>
<p hidden  class="focus_elem" ></p>

<div class="d-flex align-items-center justify-content-center flex-wrap flex-column m-auto" id="focusElement">
  <input type="submit" value="Send Message" class="btn btn-success" name="sendMsg"/>
  <br/>
  <button class="btn btn-danger"><a href="adminManageUsers.php" class="text-center text-capitalize text-light text-decoration-none"> &lt;&lt;  back</a></button>

<br/>
</div>

</form>



<br/>
<br/>
<script>
    

        const focus_element_click=$("#element");
        const focus_element=$("#focusElement");
        
        const restore_focus=()=>{
              location.href="#focusElement";
        }
        
        focus_element_click.click(()=>{
            restore_focus();
        });
            
             
             

  </script>

<script>        


  //yeah i use comment a lot... 
  $(document).ready(()=>{
    $("form").submit((e)=>{
      //prevent the form from submitting
       e.preventDefault();
       //get the typed message
       let typed_msg=$("#sending").val();
       //prepare the ajax call
       let xhttp=new XMLHttpRequest() || new ActiveXObject("Microsoft.XMLHTTP");
       
       /* //create a new date object
       let date_time=new Date();
       let hour=date.getHours (), min=date.getMinute(), sec=date.getSeconds()
       */
       xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
             
            //do nothing why should you :) 
          }
       };

       xhttp.open("POST",`adminSaveMsg.php?msg=${typed_msg}`,true);
       //send the request
       xhttp.send(typed_msg);

       //clear the msg box
       $("#sending").val(" ");
       focusElement.focus();

    })
  })
</script>

</div>
</body>

</html>