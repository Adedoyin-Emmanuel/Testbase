//get the messages from the dbase


$(document).ready(()=>{
	setInterval(()=>{
		let receiver_id=$("#receiver").val();
		//get the necessary id's with  ajax
		var xhttp=new XMLHttpRequest() ||  new ActiveXObject("Microsoft.XMLHTTP");
		xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
             console.log(this.responseText);
      	  }
    	};
		xhttp.open("GET","showMessage.php",true);
		xhttp.send();

		
	},500)
})