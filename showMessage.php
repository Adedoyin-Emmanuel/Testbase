

<?php

require_once "conn.php";

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


#check if the current person the user is chatting with has a chatting record with the user before if so, display the msgs else show an error msg

#outgoing is the the present user


$msg_present_query="SELECT * FROM users_msgs LEFT JOIN users_info ON users_msgs.User_ID = users_info.U_ID WHERE User_ID = '$ID' AND Receiver_ID = $_SESSION[receiver_id] OR User_ID =$_SESSION[receiver_id] AND Receiver_ID = '$ID' ORDER BY ID";

$run_msg_query=@mysqli_query($conn,$msg_present_query);




if(!$run_msg_query){
  die("an error occured, could not retrive messages".mysqli_error($conn));
}else{
  if(@mysqli_num_rows($run_msg_query) > 0){
   
    while($msg_row=@mysqli_fetch_assoc($run_msg_query)){

      $time_msg_sent=$msg_row["date_added"];


      #get only the time sent from the dbase
      $split_time=explode('-',$time_msg_sent);
      $legit_time=strtolower(end($split_time));

    if($msg_row["User_ID"] == $ID){
      echo '
      <div class="rounded-3 shadow-lg w-100 m-auto p-2 bg-primary text-light mb-4  left  d-flex flex-column" id="admin_sent_msg" >
      <h6 class="you mr-2 mb-1">You:</h6>


      '.$msg_row["message"].'
        
        <p id="time_sent" class="text-capitalize text-right mt-3">'. $legit_time.'</p>
    </div>

      ';
    }else{
      echo '

      <div class="rounded-3 shadow-lg w-100 m-auto  p-2 bg-dark text-light mb-4 right  d-flex flex-column" id="user_sent_msg">
      <h6>'.$msg_row["user_name"].'</h6>
     
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