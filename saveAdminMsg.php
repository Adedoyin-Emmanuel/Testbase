<?php


#check if the user clicked the send message button

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
  echo '<script> location.href="login.php" </script>';
}


  $typed_msg=mysqli_real_escape_string($conn,parse_inputs($_GET["msg"]));
  #check if the msg sent is empty

  
  if(!empty($typed_msg)){
     #process and save the typed message
    $date_time=date("d/m/y")." - ".date("h:i:s:a");

    $save_message_query="INSERT INTO admin_user_msgs (User_ID,Receiver_ID,message,date_added) VALUES ('$ID','$_SESSION[chat_admin_receiver_id]','$typed_msg','$date_time')";
    $save_message_result=mysqli_query($conn,$save_message_query);

    if(!$save_message_result){
      echo "An error occured while sending message";
         die('an error occured while sending message'
          );    
    }else{
      $typed_msg="";

    }
  }else{
    //echo "Message cannot be empty";
     die('Message Can`t be empty!
          ');
  }

?>