
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
<link rel="stylesheet" href="msgConfig.css"/>
<noscript>This application requires javaScript to run</noscript>
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


<script>
    
    $(document).ready(($)=>{
        //create the AJAX object
       setInterval(()=>{

             var xhttp=new XMLHttpRequest() ||  new ActiveXObject("Microsoft.XMLHTTP");
            xhttp.onreadystatechange = function() {
                if (this.readyState ===4 && this.status == 200) {
                     
                     //output the result from the server
                     $("#recentChatsUsers").html(this.responseText);
                  }
            };


            xhttp.open("GET","showRecentChats.php",true);
            xhttp.send();


       },200);
    });


</script>

<div class="container-fluid m-auto d-flex align-items-center justify-content-around flex-column">
    
 


<script>
    
    //check if the user submitted the form
    $(document).ready(($)=>{
        setInterval(()=>{

            $("#search").keydown(()=>{
                //get what the user typed
                const $value=$("#search").val();

                var xhttp=new XMLHttpRequest() ||  new ActiveXObject("Microsoft.XMLHTTP");
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                         //output the result from server
                         $("#searchResult").html(this.responseText);
                         
                      }
                };


            xhttp.open("POST",`getUsersBySearch.php?user_name=${$value}`,true);
            xhttp.send();

            });


        },100);
    });


</script>


<div class="w-100" >

         <div class="search_users d-flex flex-column w-100 bg-dark rounded-3">
             
             <form class="form w-100 my-2"  method="POST" action="" id="search_form">
                 
                <input type="text" name="search_users" placeholder=" 🔍 search online users." class="form-control w-100 text-light bg-dark" id="search" autocomplete="off">

             </form>

             <div class="search_result w-100 d-flex align-items-center justify-content-around flex-column" id="searchResult">
                 
             </div>


         </div>
          <div class="recentChatUsers bg-dark text-light p-5  my-3 w-100 rounded-3"id="recentChatsUsers">
                
            </div>



    </div>
       <button class="btn btn-primary text-capitalize text-center my-3"><a class="text-decoration-none text-light text-center" href="index.php">Back</a></button>

</div>
<?php require_once "footer.php";?>
</body>
</html>
