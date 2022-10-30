
<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="bootstrap.css">
<script src="jquery.js"></script>
<script src="sweetAlert2.js"></script>

<link rel="stylesheet" href="msgConfig.css">


<title>Test Base</title>

<style>
	body{
		background:#121212;
		color:white;
	}

::-webkit-scrollbar{
    width:5px;
    height:5px;
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

     {
        color:white;

        }

    input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill:hover,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea:-webkit-autofill:focus,input[type=text],input[type=password],input[type=email],input[type=number],input[type=date]:-webkit-autofill:active{
          -webkit-box-shadow: 0 0 0 30px #121212 inset !important;
          color:white;
          border:none;
    }

       @media  (max-width: 765px) {
       		
       		#content-contain{
       			flex-direction: column;
       			align-items: center;
       			justify-content: center;

       		}	
       }

 
</style>
</head>

<body class="text-light">
<?php require_once "homePageNav.php"; ?>


<div class="container-fluid text-light">

<div class="content-contain row d-flex my-4  flex-md-row" id="content-contain">
	
<h3 class="text-capitalize text-center my-4">welcome to test base</h3>
			
		<div class="img-container col p-3 ">
				<img src="background.png" height="400" width="600" class="img-fluid rounded">
		</div>
			
		<div class="text-container col  p-3 text-center">
				
				<input type="text" name="testBaseInfo" id="testBaseInfo" class="text-capitalize text-light bg-dark text-bold"/>
				<section class="text-center text-capitalize p-1" id="about_testbase">
					
					test-base is a full stack project developed by <a href="www.github.com/Adedoyin-Emmanuel" class="text-decoration-none">Adedoyin Emmanuel Adeniyi</a>
					test-base allows users to create account to take CBT, with Test-base, you can find other users on the platform and chat them up. admins can set question on the site for the users to take CBT, this could be integrated into an Edutech software to automate exams, we are working on integrating WAEC and JAMB questions API so users can also revise for SSCE exams. 

					<br/>

					<button class="btn btn-primary m-auto my-5"><a href="signUp.php" class="text-decoration-none text-light text-center">Sign Up For Free 😋</a></button>
				</section>
		</div>

</div>

		<div class="other-stories text-capitalize m-auto bg-dark p-5 rounded-3 shadow-lg my-3">
			
			<h4 class="text-capitalize text-center my-2">About EmmySoft</h4>
			
			<p id="aboutEmmysoft">Test base was created by <a href="www.github.com/Adedoyin-Emmanuel" class="text-decoration-none">Adedoyin Emmanuel Adeniyi</a>, he is a full stack developer with the following skills HTML , CSS , JAVASCRIPT , PHP , SQL , JQUERY , PYTHON , GD-SCRIPT for (Game-Development). 


			<h5 class="text-capitalize ">catch me live on social media</h5>

			<ul class="list">
					<li class="list-item "><a class="text-decoration-none text-light" href="www.facebook.com/adedoyin.emmanuel.180" target="_blank">facebook</a></li>
					<li class="list-item "><a class="text-decoration-none text-light" href="www.linkedin.com/in/adedoyin-emmanuel-5a0a71219" target="_blank">linkedin</a></li>
					<li class="list-item "><a class="text-decoration-none text-light" href="www.twitter.com/Emmysoft_Tm?t=hMqRcF6BQGs5HcfHHfh7y2A&s=09" target="_blank">twitter</a></li>
					<li class="list-item "><a class="text-decoration-none text-light" href="wa.link/wbelr1" target="_blank">whatsapp</a></li>
					<li class="list-item "><a class="text-decoration-none text-light" href="www.msng.link/0/?UnprogrammedProgrammer=tg" target="_blank">telegram</a></li>
					<li class="list-item "><a class="text-decoration-none text-light" href="www.github/adedoyin-emmanuel.com" target="_blank">Github</a></li>
					<li class="list-item "><a class="text-decoration-none text-light" href="www.emmysoftgames.itch.io/9ja-flappy-bird" target="_blank ">Game-Store</a></li>



			</ul> 
		</div>



</div>


<?php require_once "footerHomePage.php";?>





<script>


class TypingEffect{
	constructor(text,DOM_ID,textSpeed,index){
		this.text=text;
		this.textSpeed=textSpeed;
		this.index=index;
		this.DOM_ID=DOM_ID;
		this.textElapsed=false;

		this.removeText=()=>{
			
			this.DOM_ID.value = " ";
		}

		this.updateText=()=>{

			if(this.index < this.text.length){

				this.DOM_ID.value += this.text.charAt(this.index);
				
				this.index++;

				setTimeout(this.updateText,this.textSpeed);
			}

			if(this.index == this.text.length){
				this.removeText();
				this.index=0;
				this.textElapsed=true;
			}
		}
	}
}



/*
	@create a new instance of the TypingEffect


*/

let testBase=document.getElementById('testBaseInfo');
let testBaseHeading=new TypingEffect("what is test base ? ",testBase,100,0);

//call the update method on the typing text
testBaseHeading.updateText();

//adjust the header with lil bit of css

testBase.style.border="none";
testBase.style.fontSize="1.35rem";
testBase.style.fontWeight="500";


</script>

</body>

</html>