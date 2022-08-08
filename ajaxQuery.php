
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="bootstrap.css">

<link rel="stylesheet" href="style.css">
<title>Title</title>
</head>
<body>


<button class="btn btn-primary" id="btn">Get Data</button>
<div class="div" id="template"></div>

<script src="jquery.js"></script>
<script>

$("document").ready(()=>{
    $(".btn").click(()=>{
        getData();
    });
})
function getData(){

let xhttp=new XMLHttpRequest();


//perform another function while waiting for response
xhttp.onreadystatechange=()=>{
    //$("#loader").text("loading data "+ xhttp.readyState);
       //if the server response is ready
    if(xhttp.readyState==4 && xhttp.status==200){
        //remove the loader
        $("#loader").hide();
        $("#template").text(xhttp.responseText);
    }
}
xhttp.open("GET","dashboard.php",true);
xhttp.send();

}




</script>

</body>
</html>

