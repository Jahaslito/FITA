let sidebar= document.getElementById("side-bar");
let folder= document.getElementsByClassName("folder")[0];
let questionCounter= 1;


//opening the side menu
function openOverlay() {
    console.log("called");
    console.log("width: "+sidebar.style.width);
    sidebar.style.width= "30%";
    sidebar.style.display="block";      
}

//closing the side menu
function closeNav() {
document.getElementById("side-bar").style.width = "0%";
}

//Adding the csrf tkoen in ajax request 
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//logging out

function logout() {
    console.log("called");
    $.ajax({
        url: '/logout',
				method: 'post',
				success: function (result) {
					console.log("result:\n");
					console.log("successfully logged out");
                    window.location.href="/";
					},
				error: function (result) {
					console.log(result);   
				}
    });
}
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

