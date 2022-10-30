
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

echo '<nav class="hor-nav w-100 shadow-lg" style="position:fixed; width:100%; z-index:1000;">


<ul class="nav  d-flex align-items-start justify-content-start bg-primary px-3">
<span class="bg-dark text-light text-center p-1 my-1  rounded-3 d-md-none" style="cursor:pointer; width:40px; height:40px; font-size:20px" onclick="openNav()">&#9776</span>
<div id="mySidenav" class="sidenav bg-dark text-light">
<h4 class="text-capitalize text-center text-light">Test Base</h4>
  <a href="javascript:void(0)" class="closebtn  text-center text-danger my-5" onclick="closeNav()">&times;</a>
  
<hr/>
  <h5 class="text-capitalize text-center ">dashboard</h5> 
  <hr/>
  <br/>

  <li class="nav-item py-3">
    <a class="nav-link  text-capitalize text-light" id="home" href="index.php">Home</a>
  </li>
 
 <li class="nav-item py-3">
    <a class="nav-link text-capitalize text-light" id="getStarted" href="index.php">Get started</a>
  </li>
  <li class="nav-item py-3">
    <a class="nav-link text-capitalize text-light" id="aboutUs" href="#">about us</a>
  </li>

   <li class="nav-item py-3">
    <a class="nav-link text-capitalize text-light" id="support" href="#">Support</a>
  </li>
</div>
<li class="nav-item  m-auto text-center d-md-none">
    <h5 class="text-capitalize py-2 text-light">Test-Base</h5>
  </li>
</ul>
<!-- big screen nav -->
<ul class="nav nav-tabs d-flex align-items-center justify-content-around bg-primary big_screen_nav d-sm-none d-md-flex">
  <li class="nav-item big_screen">
    <a class="nav-link  text-capitalize text-light" id="home" href="index.php">Home</a>
  </li>
  <li class="nav-item big_screen">
    <a class="nav-link text-capitalize text-light" id="getStarted" href="index.php">Get started</a>
  </li>
  <li class="nav-item big_screen">
    <a class="nav-link text-capitalize text-light" id="aboutUs" href="#">about us</a>
  </li>

   <li class="nav-item big_screen">
    <a class="nav-link text-capitalize text-light" id="support" href="#">Support</a>
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
