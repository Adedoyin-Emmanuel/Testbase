
<?php
@session_start();
//start the session

const serverName="localhost";
const password="";
const database="test_cbt";
const username="root";
const serverMethod="POST";
$conn=mysqli_connect(serverName,username,password,database);

function parse_inputs($data){
	$data=trim($data);
	$data=stripslashes($data);
	$data=htmlspecialchars($data);

	return $data;
}

$all_images=array("images/change_user.png","images/chat_user2.png","images/contact.png","images/example.png","images/log_out.png","images/search.png","images/settings.gif","images/test.png","images/update_user.png");


?>