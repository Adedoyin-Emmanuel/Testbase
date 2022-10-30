
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

#prepare the get_msg query

#the sender id is the user id the r_id is the receiver id
$get_msg_query="SELECT * FROM admin_user_msgs LEFT JOIN users_info ON admin_user_msgs.User_ID = users_info.U_ID WHERE User_ID = '$ID' AND Receiver_ID = $_SESSION[admin_receiver_id] OR User_ID =$_SESSION[admin_receiver_id] AND Receiver_ID = '$ID' ORDER BY ID";


$run_msg_query=@mysqli_query($conn,$get_msg_query);



if(!$run_msg_query){
  die("an error occured, could not retrive messages".mysqli_error($conn));
}else{
  if(mysqli_num_rows($run_msg_query) > 0){
   
    while($msg_row=mysqli_fetch_assoc($run_msg_query)){

      $time_msg_sent=$msg_row["date_added"];


      #get only the time sent from the dbase
      $split_time=explode('-',$time_msg_sent);
      $legit_time=strtolower(end($split_time));

    if($msg_row["User_ID"] == $ID){
      echo '
      <div class="form rounded-3 shadow-lg w-100 m-auto p-2 bg-danger text-light mb-4  left  d-flex flex-column" id="admin_sent_msg" >
      <h6 class=" mr-2 mb-1 py-2">Admin: </h6>


      '.$msg_row["message"].'
        
        <p id="time_sent" class="text-capitalize text-right mt-3">'. $legit_time.'</p>
    </div>

      ';
    }else{
      echo '

      <div class=" form rounded-3 shadow-lg w-100 m-auto  p-2 bg-dark text-light mb-4 right  d-flex flex-column" id="user_sent_msg">
      <h6> '.$msg_row["user_name"].'</h6>
     
      '.$msg_row["message"].'
      <p id="time_sent" class="text-capitalize text-right mt-3">'. $legit_time.'</p>
    </div>


      ';
    }
  }

  }else{
     echo("<h4 class='text-center text-danger text-capitalize m-auto'>No chats avaliable</h4>");
  }
}

?>

<!-- 
<style>
  


  

    @media  (min-width: 992px) {
        .form{
            width:50%;
        }
    }

</style>
 -->