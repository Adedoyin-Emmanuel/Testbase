$(document).ready(()=>{
	setInterval(()=>{

		//create the xmlXTTP request for the ajax call
	  var xhttp=new XMLHttpRequest() ||  new ActiveXObject("Microsoft.XMLHTTP");
	  xhttp.onreadystatechange = function() {
	  		//check if the request went well
	        if (this.readyState == 4 && this.status == 200) {
	             console.log(this.responseText);
	             $("#data_div").html(this.responseText);
	        }

	        xhttp.open("GET","adminShowMessages.php",true);
	        xhttp.send();
	  };


	},100);
})