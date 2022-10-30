$(document).ready(() => {
    $(".log-out").click(() => {
        swal.fire({
            title: "Admin Log-Out",
            text: "Dear Admin, Are you sure you want to log out of this account.. logging in, requires valid username and password....",
            icon: "info",
            showCancelButton: true,
            showConfirmButton: true,
            showCloseButton: true,
            allowOutsideClick: false,
            timerProgressBar: true,
            confirmButtonColor: "tomato",
            confirmButtonText: "Log-Out",
            cancelButtonColor: "dodgerblue"

        }).then((willProceed) => {
            if (willProceed.isConfirmed) {
                location.href = "adminLogout.php";
            } else {
                return;
            }
        })
    });

    $(".update-profile").click(() => {
        //navigate the admin to the admin profile page

        swal.fire({
            title: "Update Admin Profile",
            text: "Dear admin, you have updated your profile when you signed in for the first time, your details were used to update your profile, you can always change your profile details anytime",
            icon: "question",
            showCancelButton: true,
            showConfirmButton: true,
            showCloseButton: true,
            allowOutsideClick: false,
            timerProgressBar: true,
            confirmButtonColor: "dodgerblue",
            confirmButtonText: "Change Profile Details",
            cancelButtonColor: "Tomato"

        }).then((willProceed) => {
            if (willProceed.isConfirmed) {
                location.href = "adminChangeProfile.php";
            }
        })
    });


    $(".manage-users").click(() => {
        //naviagate the admin to the manage users page


        swal.fire({
            title: "Manage Users",
            text: "Do you want to proceed to the manage users page?",
            icon: "question",
            timer: 6000,
            showCancelButton: true,
            showConfirmButton: true,
            showCloseButton: true,
            allowOutsideClick: false,
            timerProgressBar: true,
            confirmButtonColor: "dodgerblue",
            confirmButtonText: "Proceed",
            cancelButtonColor: "Tomato"

        }).then((willProceed) => {
            if (willProceed.isConfirmed) {
                location.href = "adminManageUsers.php";
            }
        });

    });

    $(".cbt-settings").click(() => {
        //naviagate the admin to the cbt settings page

        swal.fire({
            title: "CBT Settings",
            text: "Do you want to proceed to the CBT settings page?",
            icon: "question",
            timer: 6000,
            showCancelButton: true,
            showConfirmButton: true,
            showCloseButton: true,
            allowOutsideClick: false,
            timerProgressBar: true,
            confirmButtonColor: "dodgerblue",
            confirmButtonText: "Proceed",
            cancelButtonColor: "Tomato"

        }).then((willProceed) => {
            if (willProceed.isConfirmed) {
                location.href = "adminCbtSettings.php";
            }
        });

    });

    $(".admin-actions").click(() => {
        //naviagate the admin to the admin actions page
        swal.fire({
            title: "Admin-Action",
            text: "Do you want to proceed to the admin action page?",
            icon: "question",
            timer: 6000,
            showCancelButton: true,
            showConfirmButton: true,
            showCloseButton: true,
            allowOutsideClick: false,
            timerProgressBar: true,
            confirmButtonColor: "dodgerblue",
            confirmButtonText: "Proceed",
            cancelButtonColor: "Tomato"

        }).then((willProceed) => {
            if (willProceed.isConfirmed) {
                location.href = "adminActions.php";
            }
        });

    });

    $(".view-profile").click(() => {
        //naviagate the admin to the view profile page


        swal.fire({
            title: "View Profile",
            text: "Do you want to proceed to the view profile page?",
            icon: "question",
            timer: 6000,
            showCancelButton: true,
            showConfirmButton: true,
            showCloseButton: true,
            allowOutsideClick: false,
            timerProgressBar: true,
            confirmButtonColor: "dodgerblue",
            confirmButtonText: "Proceed",
            cancelButtonColor: "Tomato"

        }).then((willProceed) => {
            if (willProceed.isConfirmed) {
                location.href = "adminViewProfile.php";
            }
        });
    });

});