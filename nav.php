
<script src="userPageNav.js"></script>

<style>
  


.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 20px;
    color: #818181;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover {
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
    color:white;

}


  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
  .sidenav::-webkit-scrollbar{
    width:5px;
    height:5px;
    background:#121212;

  }

  .sidenav::-webkit-scrollbar-thumb{
    border-radius:10px;
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


</style>
<?php
require_once "conn.php";

if(!empty($_SESSION["ID"])){
	#this means someone is logged in
	$ID=$_SESSION["ID"];
	$query="SELECT * FROM users WHERE ID = $ID";
	$result=@mysqli_query($conn,$query);
	$row=@mysqli_fetch_array($result);

}else{
	echo '<script>

    location.href="logIn.php";

  </script>';
}

echo '<nav class="hor-nav w-100 shadow-lg" style="position:fixed; width:100%; z-index:1000;">


<ul class="nav  d-flex align-items-start justify-content-start bg-primary px-3">
<span class="bg-dark text-light text-center p-1 my-1  rounded-3 d-md-none" style="cursor:pointer; width:40px; height:40px; font-size:20px" onclick="openNav()">&#9776</span>
<div id="mySidenav" class="sidenav bg-dark">
  
  <a href="javascript:void(0)" class="closebtn  text-center text-danger" onclick="closeNav()">&times;</a>
 <img src='."profilePic/".@$user_info_row["profile_picture"]. ' class=" rounded-circle my-3" id="profilePic" height="40" width="40">
<br/><br/>
  <h4 class="text-capitalize text-center ">dashboard</h4> 
  <hr/>
  <br/>
  <h5 class="text-capitalize text-bold  px-1">Howdy, '.$row[1].'</h5>

  <li class="nav-item py-3">
    <a class="nav-link  text-capitalize text-light" id="home" href="index.php">Home</a>
  </li>
  <li class="nav-item py-3">
    <a class="nav-link text-capitalize text-light" id="takeCbt" href="takeCbt.php">take CBT</a>
  </li>
  <li class="nav-item py-3">
    <a class="nav-link text-capitalize text-light" id="aboutUs" href="#">about us</a>
  </li>
  <li class="nav-item py-3">
    <a class="nav-link text-capitalize text-light log-out" id="" href="#">log out</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-capitalize text-light find-users py-3" id="findUsers" href="#">Find Users</a>
  </li>
    <li class="nav-item py-3">
    <a class="nav-link text-capitalize text-light message-users" id="messageUsers" href="#">Message Users</a>
  </li>

    </li>
    <li class="nav-item  py-3">
    <a class="nav-link text-capitalize text-light change-profile" id="changeProfile" href="changeProfile.php">Change Profile</a>
  </li>


    <li class="nav-item  py-3">
    <a class="nav-link text-capitalize text-light view-profile" id="viewProfile" href="userProfile.php">View Profile</a>
  </li>

    
    <li class="nav-item  py-3">
    <a class="nav-link text-capitalize text-light view-profile" id="messageAdmin" href="messageAdmin.php">Message Admin</a>
  </li>

    
    
    <li class="nav-item  py-3">
    <a class="nav-link text-capitalize text-light contact-admin" id="contactAdmin" href="contactAdmin.php">Contact Admin</a>
  </li>

</div>
<li class="nav-item  m-auto text-center d-md-none">
    <h5 class="text-capitalize py-2">Test-Base</h5>
  </li>
</ul>
<!-- big screen nav -->
<ul class="nav nav-tabs d-flex align-items-center justify-content-around bg-primary big_screen_nav d-sm-none d-md-flex">
  <li class="nav-item big_screen">
    <a class="nav-link  text-capitalize text-light" id="home" href="index.php">Home</a>
  </li>
  <li class="nav-item big_screen">
    <a class="nav-link text-capitalize text-light" id="takeCbt" href="takeCbt.php">take CBT</a>
  </li>
  <li class="nav-item big_screen">
    <a class="nav-link text-capitalize text-light" id="aboutUs" href="#">about us</a>
  </li>
  <li class="nav-item big_screen">
    <a class="nav-link text-capitalize text-light log-out" id="" href="#">log out</a>
  </li>
  <li class="nav-item big_screen">
    <a class="nav-link text-capitalize text-light find-users" id="findUsers" href="findUsers.php">Find Users</a>
  </li>
    <li class="nav-item big_screen">
    <a class="nav-link text-capitalize text-light message-users" id="messageUsers" href="showUsers.php">Message Users</a>
  </li>

   
    <li class="nav-item big_screen">
    <a class="nav-link text-capitalize text-light change-profile" id="changeProfile" href="changeProfile.php">Change Profile</a>
  </li>


    <li class="nav-item big_screen">
    <a class="nav-link text-capitalize text-light view-profile" id="viewProfile" href="userProfile.php">View Profile</a>
  </li>
  

   <li class="nav-item big-screen">
    <a class="nav-link text-capitalize text-light message-admin" id="messageAdmin" href="messageAdmin.php">Message Admin</a>
  </li>
  
    <li class="nav-item big-screen">
    <a class="nav-link text-capitalize text-light contact-admin" id="contactAdmin" href="contactAdmin.php">Contact Admin</a>
  </li>


</ul>
</nav>';
 echo "<br/>";
 echo "<br/>";
 echo "<br/>";

?>

<style>
  

  .nav-item{
    border:none;
  }


 /*   @media (width: 992px) {
        .big_screen{
           display: none;
        }
    }

*/

  @media (max-width: 576px) {
    .big_screen_nav{
      display: none !important;
    }
 
  }
</style>

<script>
  


    function openNav() {
        document.getElementById("mySidenav").style.width = "100%";
    }   

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }

</script>
