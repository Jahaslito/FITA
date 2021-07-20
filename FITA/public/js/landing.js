
//going to the next question
$(document).ready(function(){
    let firstQuestion= $("#first-question");
    let secondQuestion= $("#second-question");
    let thirdQuestion= $("#third-question");
    let fourthQuestion= $("#fourth-question");
    let backButton=$("#back");
    $("#submit").click(function(event){
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
                alert("functionality yet to come");
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

