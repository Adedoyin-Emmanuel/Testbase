<?php
require_once "../conn.php";
#update the database for the logout
$admin_status=0;
$ID=$_SESSION["Admin_ID"];
$admin_logout_query="UPDATE admin_info SET status = '$admin_status' WHERE A_ID ='$ID';";
$admin_logout_query.="UPDATE admin SET status='$admin_status' WHERE ID ='$ID'";

#check if the connection was successful
if(!$conn){
    die("error occured cannot connect to the database");
}

$admin_query_result=mysqli_multi_query($conn,$admin_logout_query);

if(!$admin_query_result){
    die("error occured, couldn't update database");
}else{
    session_unset($ID);
    session_destroy();
    $_SESSION["Admin_ID"]=array();

    header("Location: adminLogin.php");
}



?>