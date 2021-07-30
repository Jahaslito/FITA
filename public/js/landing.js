var questionCounter=1;
//going to the next question
$(document).ready(function(){
    let firstQuestion= $("#first-question");
    let secondQuestion= $("#second-question");
    let thirdQuestion= $("#third-question");
    let fourthQuestion= $("#fourth-question");
    let backButton=$("#back");
    $("#screening-data-form").submit(function(event){
        console.log("called");
        event.preventDefault();
        switch (questionCounter) {
            case 1:
                firstQuestion.hide();
                secondQuestion.show();
                backButton.show();
                break;
            case 2:
                secondQuestion.hide();
                thirdQuestion.show();
                break;
            case 3:
                thirdQuestion.hide();
                fourthQuestion.show();
                break;
            case 4:
                if (confirm("Do you want to submit the form?")) {
                    let formData= new FormData(this);
                let messageBox= $("#response_message");
                $.ajax({
                    type:'POST',
                    url: '/submit-screening-data',
                     data: formData,
                     contentType: false,
                     processData: false,
                     success: function(result){
                       if (result=='success') {
                        displayMessage(messageBox,'success',"Data submitted successfully");
                       }else{
                        displayMessage(messageBox,'error',result);
                       }
                     },
                     error: function(result){
                         console.log(result);
                        let error= result.responseJSON.errors;
                        let concatenatedErrors="";
                        if(error.question_two) {concatenatedErrors+= error.question_two[0]+"<br>"};
                        if(error.question_three) {concatenatedErrors+= error.question_three[0]+"<br>"};
                        if(error.question_four) {concatenatedErrors+= error.question_four[0]+"<br>"};
                        
                        displayMessage(messageBox,"error",concatenatedErrors);
                        uploadProfileMessage=""
                     }
                 });
                }
                break;
            default:
                break;
        }
        questionCounter++;
    });
    $("#back").click(function(){
        switch (questionCounter) {
            case 2:
                secondQuestion.hide();
                firstQuestion.show();
                backButton.hide();
                break;
            case 3:
                thirdQuestion.hide();
                secondQuestion.show();
                break;
            case 4:
                fourthQuestion.hide();
                thirdQuestion.show();
            default:
                break;
        }
        questionCounter--;
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
    }, 6000);
}

