//Adding the csrf tkoen in ajax request 
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    $("#update_personal_details").click(function (event) {
       event.preventDefault();
       if (confirm("Do you want to save changes?")) {
       let firstName= $("#first-name").val();
       let lastName= $("#last-name").val();
       let dateOfBirth= $("#date-of-birth").val();
       let phone_number= $("#phone-number").val();
       let address= $("#address").val(); 
      
       let postData= {
            first_name: firstName,
            last_name: lastName,
            date_of_birth: dateOfBirth,
            address: address,
            phone_number:phone_number
        }
        let messageBox= $("#personal-detail-message");
       $.ajax(
        {
            url:'/personal_details',
            method: 'post',
            data:postData,
            success: function(result) {
                if (result=='success') {
                    displayMessage(messageBox,"success","Changes updated Successfully");
                }
            },
            error: function(result) {
                displayMessage(messageBox,"error","All fields are required");
            }
        });
        }  
    });

    $("#change_password").click(function (event) {
        event.preventDefault();
        if (confirm("Do you want to save changes?")) {
            let currentPassword= $("#current-password").val();
            let newPassword= $("#new-password").val();
            let verifyPassword= $("#verify-password").val();
           
            let postData= {
                 current_password: currentPassword,
                 new_password: newPassword,
                 verify_password: verifyPassword,
             }

             console.log(currentPassword);
             console.log(newPassword);
             console.log(verifyPassword);
            let pMessageBox= $("#change-password-message");
            $.ajax(
             {
                 url:'/password',
                 method: 'post',
                 data:postData,
                 success: function(result) {
                    if (result=='success') {
                        displayMessage(pMessageBox,"success","Password Changed Successfully");
                    }else if(result=='WP'){
                        displayMessage(pMessageBox,"error","Wrong Password");
                    }else if(result=='MP'){
                        displayMessage(pMessageBox,"error","Password Mismatch");
                    }
                 },
                 error: function(result) {
                     displayMessage(pMessageBox,"error","All fields are requried");
                 }
             });   
        }
     });

     $("#change_email").click(function (event) {
        event.preventDefault();
        if (confirm("Do you want to save changes?")) {
            let email= $("#email").val();
        
            let postData= {
                email: email,
            }
            let messageBox= $("#change-email-message");
            $.ajax(
            {
                url:'/setting',
                method: 'post',
                data:postData,
                success: function(result) {
                    if (result=='success') {
                        displayMessage(messageBox,"success","Verification link is sent to your new email!");
                    }else{
                        displayMessage(messageBox,"error",result);
                    }
                },
                error: function(result) {
                    let error= result.responseJSON.errors.email[0];
                    displayMessage(messageBox,"error",error);
                }
            });
        }  
     });
});

//To display error or success messages
function displayMessage(messageBox,type,message) {
    messageBox.html(message);
    messageBox.addClass(type);
    messageBox.css("display","block");
    setTimeout(function() {
        messageBox.css("display","none");
        messageBox.removeClass(type);
    }, 4000);
}