$(document).ready(()=>{
  setInterval(()=>{
    //create the xmlhttp obj
    let xhttp=new XMLHttpRequest() || new ActiveXObject("Microsoft.XMLHTTP");
    //get the statusContainer
    let status=$("#getUserStatus");

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //get the user status from the server
            status.text(this.responseText);
            focusElement.focus();
      }
    };

    xhttp.open("GET","getAdminStatus.php",true);
    xhttp.send();



  },100);
});
