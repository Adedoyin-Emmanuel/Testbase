<?php

require_once "conn.php";
#get the use information from the dbase using the query string
$get_user_info="SELECT * FROM admin_info WHERE A_ID ='$_SESSION[chat_admin_receiver_id]'";
$get_user_info_result=@mysqli_query($conn,$get_user_info);

$default_status=" ";


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
          echo $default_status;
        }else{
          $default_status="offline";
          echo $default_status;
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