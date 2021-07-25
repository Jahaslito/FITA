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