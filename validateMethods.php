
<?php
include_once "message.php";

#connect to the database

//create a custom function to throw error for incomplete details
function incomplete_details_error(){
    echo '<script>
        errorLog.style.display="flex";
        //errorLog.style.color="red";

        //throw_msg(" ","Details Incomplete" ,2000,"error");
        // throw_msg(" ","SignUp Details Incomplete" ,4000,"error");

        var errorMsg="*SignUp Details Incomplete Please Check And Try Again.*";
        Error_Log("red",errorMsg);
        </script>';


    die();

}

//create a function to throw a custom error
function search_input_empty(){
    echo '<script>
    errorLog.style.display="flex";


    var errorMsg="*search input cannot be empty!*";
    Error_Log("red",errorMsg);
    </script>';


die();
}

//create a function to throw a custom error
function search_result_empty(){
    echo '<script>
    errorLog.style.display="flex";


    var errorMsg="*no results found!*";
    Error_Log("red",errorMsg);



    </script>';
    
    die();
}
//create a function to throw a custom error
function search_order_empty(){
   
    echo '<script>
    errorLog.style.display="flex";


    var errorMsg="*please select a search order*!*";
    Error_Log("red",errorMsg);
    </script>';


die();
}


//create a custom function to throw error for incomplete details
function incomplete_update_error(){
    echo '<script>
        errorLog.style.display="flex";
        //errorLog.style.color="red";

        //throw_msg(" ","Details Incomplete" ,2000,"error");
        // throw_msg(" ","SignUp Details Incomplete" ,4000,"error");

        var errorMsg="*profile update Details Incomplete Please Check And Try Again.*";
        Error_Log("red",errorMsg);
        </script>';


    die();

}

function username_or_description_empty(){
    echo '<script>
    errorLog.style.display="flex";


    var errorMsg="username or problem description can`t be empty";
    Error_Log("red",errorMsg);
    </script>';



}

//create a custom function to throw error for incomplete details
function profile_server_error(){
    echo '<script>
        errorLog.style.display="flex";
        //errorLog.style.color="red";

        //throw_msg(" ","Details Incomplete" ,2000,"error");
        // throw_msg(" ","SignUp Details Incomplete" ,4000,"error");

        var errorMsg="*profile not found on server!*";
        Error_Log("red",errorMsg);
        </script>';


    die();

}

//create a custom function to throw error for complete details
function profile_update_success(){
    echo '<script>
        errorLog.style.display="flex";
        //errorLog.style.color="red";

        //throw_msg(" ","profile updated succcessfully" ,4000,"success");


        swal.fire({
            toast:true,
            position:"top-right",
            timerProgressBar:true,
            icon:"success",
            timer:4000,
            text:"You Have Updated Your Profile Successfully, You Can Always Change Your Details On The Dashboard",
            title:"Profile Update",
            showConfirmButton:true,
            showCancelButton:true,
            allowEnterKey:false,
            allowOutsideClick:false,
            cancelButtonColor:"tomato",
            confirmButtonColor:"dodgerblue",
            confirmButtonText:"Proceed To Dashboard..."
    
        }).then((willProceed)=>{
            if(willProceed.isConfirmed){
                //navigate the user back to the dashboard
                location.href="index.php";
            }else{
                location.href="index.php";
            }
                location.href="index.php";
        })



        var errorMsg="*profile updated succcessfully*";
        Error_Log("red",errorMsg);
        errorLog.style.background="green";
        </script>';

}


//create a custom function to throw error for complete details
function profile_change_success(){
    echo '<script>
        errorLog.style.display="flex";
        
        

        swal.fire({
            toast:false,
            position:"center",
            timerProgressBar:true,
            icon:"success",
            timer:4000,
            text:"Your Profile Has Been Successfully Updated, Proceed To Dashboard...",
            title:"Profile Update",
            showConfirmButton:true,
            showCancelButton:true,
            allowEnterKey:false,
            allowOutsideClick:false,
            cancelButtonColor:"tomato",
            confirmButtonColor:"dodgerblue",
            confirmButtonText:"Proceed To Dashboard..."
    
        }).then((willProceed)=>{
            if(willProceed.isConfirmed){
                //navigate the user back to the dashboard
                location.href="index.php";
            }else{
                location.href="index.php";
            }
                location.href="index.php";
        })

        var errorMsg="*your profile details was updated succcessfully*";
        Error_Log("red",errorMsg);
        errorLog.style.background="green";
        </script>';



}

function  admin_profile_change_success(){
    echo '<script>
    errorLog.style.display="flex";
    
    

    swal.fire({
        toast:false,
        position:"center",
        timerProgressBar:true,
        icon:"success",
        timer:4000,
        text:"Admin Profile Update Was Successfully, Proceed To Dashboard...",
        title:"Profile Update",
        showConfirmButton:true,
        showCancelButton:true,
        allowEnterKey:false,
        allowOutsideClick:false,
        cancelButtonColor:"tomato",
        confirmButtonColor:"dodgerblue",
        confirmButtonText:"Proceed To Admin Dashboard..."

    }).then((willProceed)=>{
        if(willProceed.isConfirmed){
            //navigate the admin back to the dashboard
            location.href="index.php";
        }else{
            location.href="index.php";
        }
            location.href="index.php";
    })

    var errorMsg="*admin,your profile details was updated succcessfully*";
    Error_Log("red",errorMsg);
    errorLog.style.background="green";
    </script>';



}

//create a custom function to throw error for invalid email
function invalid_email(){
    echo '<script>
        errorLog.style.display="flex";
        //errorLog.style.color="red";

        //throw_msg(" ","Invalid E-mail" ,2000,"error");
        //throw_msg(" ","Invalid E-mail" ,4000,"error");

        var errorMsg="*Invalid E-mail, Try Again.*";
        Error_Log("red",errorMsg);
        </script>';


    die();

}


function subject_exist_error(){
    echo '<script>
        errorLog.style.display="flex";
        //errorLog.style.color="red";

        //throw_msg(" ","Invalid E-mail" ,2000,"error");
        //throw_msg(" ","Invalid E-mail" ,4000,"error");

        var errorMsg="*Subject already exist, enter another subject name.*";
        Error_Log("red",errorMsg);
        </script>';


    die();

}


function subject_added_success($subject){
    echo '<script>
        errorLog.style.display="flex";

        var errorMsg="*'.$subject.' added successfully.*";
        errorLog.style.background="green";
        Error_Log("red",errorMsg);
        </script>';

}

function enter_valid_subject_name(){
    echo '<script>
        errorLog.style.display="flex";

        var errorMsg="*Abeg enter a valid subject name!.*";
        
        Error_Log("red",errorMsg);
        </script>';

}

//create a custom function to throw error for unmatch passwords
function unmatch_password(){
echo '<script>
        errorLog.style.display="flex";
        //errorLog.style.color="red";
        var customMsg="*Passwords Are Not The Same*";
        for(let i=0; i<2; i++){
            document.getElementsByClassName("pCheck")[i].style.borderBottom = "2px solid red";
        }
        //throw_msg(" ","Sign Up Error" ,4000,"error");

        Error_Log("red",customMsg);

        </script>';

    die();
}

//create a custom function to throw error for the large file size
function large_uploaded_file(){
    echo '<script>
            errorLog.style.display="flex";
            //errorLog.style.color="red";
            var customMsg="*whoza, the uploaded file is too large*";
            
            //throw_msg(" ","Sign Up Error" ,4000,"error");
    
            Error_Log("red",customMsg);
    
            </script>';
    
        die();
}


//create a custom function to throw error for the wrong file extension
function wrong_file_extension(){
    echo '<script>
            errorLog.style.display="flex";
            //errorLog.style.color="red";
            var customMsg="*Uploaded file extention not supported, try png, jpeg, jpg or gif*";
            
            //throw_msg(" ","Sign Up Error" ,4000,"error");
    
            Error_Log("red",customMsg);
    
            </script>';
    
        die();
}



//create a custom function to throw error for the unknown file handing error
function unknown_file_error(){
    echo '<script>
            errorLog.style.display="flex";
            //errorLog.style.color="red";
            var customMsg="*An unknown error occured during file upload*";
            
            //throw_msg(" ","Sign Up Error" ,4000,"error");
    
            Error_Log("red",customMsg);
    
            </script>';
    
        die();
}

  
  
    

//create a custom function to handle the proper details
function correct_signup_details(){
    echo '<script>
         errorLog.style.display="flex";
         //errorLog.style.color="green";
         var successMsg="*Account Created Successfully*";
         throw_msg("Welcome","Sign Up Successful" ,3000,"success");
         errorLog.style.background="green";
         Error_Log("green",successMsg);
    
         </script>';
}


//create a custom login error_get_last
function correct_login_details(){
    echo '<script>
       
         errorLog.style.display="flex";
         //errorLog.style.color="green";
         var successMsg="*Login Successful ✨*";
        
         throw_msg("Welcome Chief.","Login Successful ✨✨" ,3000,"success");
         errorLog.style.background="green";
         Error_Log("green",successMsg);
    
         </script>';
}



//create a custom incorrect login details
function incomplete_login_error(){
    echo '<script>
         errorLog.style.display="flex";
         //errorLog.style.color="green";
         var errorMsg="*Login Details Incomplete*";
         //throw_msg("Error","Login Details Incomplete" ,4000,"error");
         Error_Log("red",errorMsg);
    
         </script>';

         die();
}
function unknown_error_msg(){
    echo '<script>
    errorLog.style.display="flex";
    //errorLog.style.color="green";
    var errorMsg="*An Unknown Error Occured*";
    //throw_msg("Error","An Unknown Error Occured" ,4000,"error");
    Error_Log("red",errorMsg);

    </script>';

   die();
}

function username_error(){
    echo '<script>
    errorLog.style.display="flex";
    //errorLog.style.color="green";
    var errorMsg="*Username already exist*";
    //throw_msg("Error","Username already exist" ,4000,"error");
    Error_Log("red",errorMsg);

    </script>';

    die();
}
function user_not_exist(){
    echo '<script>
    errorLog.style.display="flex";
    //errorLog.style.color="red";
    var errorMsg="*Username does not exist*";
    //throw_msg("Error","Username does not exist" ,4000,"error");
    Error_Log("red",errorMsg);

    </script>';

    die();
}

function msg_sent_success(){
    echo '<script>
    errorLog.style.display="flex";
    //errorLog.style.color="red";
    var errorMsg="*Message sent successfully*";
    //throw_msg("Error","Username does not exist" ,4000,"error");
    Error_Log("red",errorMsg);
    errorLog.style.background="green";
    </script>';

  
}
//create a custom login validation
function wrong_login_details(){
    echo '<script>
         errorLog.style.display="flex";
         //errorLog.style.color="green";
         var errorMsg="*Incorrect Password 😥*";
         for(let i=0; i<2; i++){
             if(i==0)continue;
            document.getElementsByClassName("loginInputs")[i].style.border = "2px solid red";
        }

         throw_msg(" ","Wrong Password 😥" ,1500,"error");
         Error_Log("red",errorMsg);
    
         </script>';

         die();
}

//create a custom admin login validation
function wrong_admin_login_details(){
    echo '<script>
         errorLog.style.display="flex";
         
         var errorMsg="*Incorrect Username Or Password*";
         for(let i=0; i<2; i++){
             //if(i==0)continue;
            document.getElementsByClassName("loginInputs")[i].style.border = "2px solid red";
        }
         //throw_msg(" ","Wrong Username Or Password" ,4000,"error");
         Error_Log("red",errorMsg);
    
         </script>';

         die();
}

function admin_login_incomplete(){
    echo '<script>
         errorLog.style.display="flex";
         //errorLog.style.color="green";
         var errorMsg="*Click the admin login to login as an admin*";
         for(let i=0; i<1; i++){
             
            document.getElementsByClassName("admin")[i].style.color = "red";
        }
         //throw_msg(" ","Click the admin login to login as an admin" ,4000,"error");
         Error_Log("red",errorMsg);
    
         </script>';

         die();
}



?>