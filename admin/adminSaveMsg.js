//check if the DOM is loaded
$(document).ready(()=>{

	$("form").submit((e)=>{
		//submit the form not
		e.preventDefault();


		//create a new XMLhttp request object
		let xhttp=new XMLHttpRequest() ||  new ActiveXObject("Microsoft.XMLHTTP");
		let typed_msg=$("#sending").val();

		xhttp.onreadystatechange = ()=>{
			//check if the connection is okay
			if(this.status == 200 && this.readyState == 4){

				//do nothing because why not
			}else{
				// $("#errorLog").show();
				// $("#errorLog").text(this.responseText);
				// console.log(this.responseText);
			}
		}

		xhttp.open("POST",`adminSaveMsg.php?msg=${typed_msg}`,true);
		 // xhttp.open("POST",`saveMsg.php?msg=${typed_msg}`,true);
		xhttp.send();

		//reset the msg box
		$("#sending").val(" ");
		$("#sending").focus();

	});
		

});