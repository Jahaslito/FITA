
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

function profile(){
    window.location.href="/profile";
}
function screeningData(){
    window.location.href="/home";
}
function trainFace(){
    window.location.href="/train_face";
}