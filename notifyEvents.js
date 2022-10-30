/*

	@author => Adedoyin Emmanuel Adeniyi



*/

"use strict";

$(document).ready(($)=>{
	//no conflict jquery
	$.noConflict();
	


	//check if any of the notify buttons are clicked

	$("#active_users").click(()=>{
		swal.fire({
			title:"Active users",
			text:"You can message or view active users profiles",
			icon:"info",
			confirmButtonText:"View active users",
			showCancelButton:true,
			showConfirmButton:true,
			allowOutsideClick:false,
			allowEnterKey:false,
			allowEscapeKey:false,
			cancelButtonColor:"tomato",
			confirmButtonColor:"dodgerblue"
		}).then((willProceed)=>{
			if(willProceed.isConfirmed){
				location.href="showOnlineUsers.php";

			}else{
				return;
			}
		})
	});
});