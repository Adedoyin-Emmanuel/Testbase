<?php

// echo '<link rel="stylesheet" href="msgConfig.css">
// ';

// echo '<link rel="stylesheet" href="../msgConfig.css"/>';
echo '<script>
function throw_msg(title,text,timer,icon){
    swal.fire({
        toast:false,
        position:"top",
        timerProgressBar:true,
        icon:icon,
        timer:timer,
        text:text,
        title:title,
        showConfirmButton:false

        

    });

}


</script>';


?>