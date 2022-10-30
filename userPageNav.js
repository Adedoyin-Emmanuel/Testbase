$(document).ready(() => {
    $(".log-out").click(() => {
        swal.fire({
            title: "Log-Out",
            text: "Are you sure you want to log out of this account, logging back in would require a valid username and password",
            icon: "info",
            // timer: 5000,
            showCancelButton: true,
            showConfirmButton: true,
            showCloseButton: true,
            allowOutsideClick: false,
            timerProgressBar: true,
            cancelButtonColor: "tomato"

        }).then((willProceed) => {
            if (willProceed.isConfirmed) {
                location.href = "logOut.php";
            } else {
                return;
            }
        })
    });

    $(".update-profile").click(() => {
        //perform operation
        location.href = "updateProfile.php";
    });


    $(".take-cbt").click(() => {
        //perform operation
        location.href = "takeCbt.php";
    });

    $(".exam-history").click(() => {
        //perform operation
    });

    $(".contact-admin").click(() => {
       //location.href="contactAdmin.php";
    });



    $(".find-users").click(() => {
        location.href = "findUsers.php";
    })

    $(".view-profile").click(() => {
        //perform operation
        location.href = "userProfile.php";
    });

    $(".message-users").click(() => {
        //perform operation
        location.href = "showUsers.php";
    });



    function openNav() {
        document.getElementById("mySidenav").style.width = "100%";
    }   

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }


      $("#take_a_tour").click(()=>{
          openNav(); 
      
     });


});