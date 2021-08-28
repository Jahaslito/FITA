// variable that checks which option of photo upload is selected
//1. Direct upload of a photo
//2. Taking a photo using the webcam

//3. Use the profile Image
var uploadOption=1; 
var imageUrl;
// Set constraints for the video stream
var constraints = { video: { facingMode: "user" }, audio: false };
// Define constants
var cameraTrigger = document.querySelector("#camera_trigger");

//containers
var takePhotoContainer=document.getElementById('take-photo-container');
var uploadPhotoContainer=document.getElementById('upload-photo-container');
var profilePhotoContainer=document.getElementById('profile-photo-container');

//main buttons
var takePhoto= document.getElementById('take-photo');
var uploadPhoto= document.getElementById('upload-photo');
var profilePhoto= document.getElementById('profile-photo');

//Buttons inside taking a photo
var openCamera= document.getElementById('camera_open');
var closeCamera= document.getElementById('camera_close');
var capture= document.getElementById('camera_trigger');
var cameraView = document.querySelector("#camera_view");
var cameraSensor = document.querySelector("#camera_sensor");

//click Upload photo button
let clickUploadPhoto= document.getElementById('click-upload-photo');
//uploaded photo
let uploadedPhoto= document.getElementById('uploaded-photo');

// Access the device camera and stream to cameraView
function cameraStart() {
    navigator.mediaDevices
        .getUserMedia(constraints)
        .then(function(stream) {
        track = stream.getTracks()[0];
        cameraView.srcObject = stream;
    })
    .catch(function(error) {
        console.error("Oops. Something is broken.", error);
    });
}
function cameraEnd() {
    let stream= cameraView.srcObject;
    var tracks = stream.getTracks();

    for (var i = 0; i < tracks.length; i++) {
      var track = tracks[i];
      track.stop();
    }
}
// Take a picture when cameraTrigger is tapped
// capture.onclick = function() {
//     cameraSensor.width = cameraView.videoWidth;
//     cameraSensor.height = cameraView.videoHeight;
//     cameraSensor.getContext("2d").drawImage(cameraView, 0, 0);
//    // cameraOutput.src = cameraSensor.toDataURL("image/webp");
//     imageUrl=cameraSensor.toDataURL("image/webp");
// };

// Start the video stream when the button start camera is clicked
openCamera.onclick= function() {
    cameraStart();
};
// End the video stream when the button start camera is clicked
closeCamera.onclick=function () {
    cameraEnd();
};

function getImageUrl(){
       cameraSensor.width = cameraView.videoWidth;
        cameraSensor.height = cameraView.videoHeight;
        cameraSensor.getContext("2d").drawImage(cameraView, 0, 0);
        imageUrl=cameraSensor.toDataURL("image/webp");
        return imageUrl;
}

// Using Jquery and AJAX to make requests directly to the server
$(document).ready(function(){
    var cameraView = $("#camera_view");
var cameraSensor = $("#camera_sensor");
        
    $("#identify-button").click(function(){
        let imageUrl= getImageUrl();
        let formData= new FormData();
        formData.append("uploaded_photo",imageUrl);
        $.ajax({
            url: '/identify_face',
            data:formData,
            method: "post",
            contentType: false,
            processData: false,
            success:function(result) {
                if (result=="ERROR_1") {
                    console.log("No match found");
                    modifiedDisplayMessage("new-error","No much found");
                }else if(result=="ERROR_2"){
                    modifiedDisplayMessage("new-error","Oops,something wrong");
                    console.log("Oops,something wrong");
                }else{
                    // success message
                    // Full name of the identified person will be displayed
                    
                    result= JSON.parse(result);
                    let name= "Name: "+result.name;
                    let status= result.screeningData;
                    console.log("Name: "+name);
                    console.log("Screening Data: "+status);

                    modifiedDisplayMessage("new-success",name);
                    setTimeout(() => {
                        toastr.clear();
                    }, 1000);
                    setTimeout(function() {
                        if (status=="Not Filled") {
                            modifiedDisplayMessage("new-error","Daily Screening data not filled");
                        }else{
                            modifiedDisplayMessage("new-success","Proceed to get your temperature measured");
                        }
                    }, 3000);
                    
                    
                }
            },
            error:function(result){
                console.log(result);
            }
        });
    });
});



function changeImage(input){
    let imageHolder= document.getElementById("uploaded-image-holder");
    var file= input.files[0];
    if (file) {
        const reader= new FileReader();
            reader.addEventListener('load', function(){
            imageHolder.src = this.result;
        });
        reader.readAsDataURL(file);
    }
}
function modifiedDisplayMessage(className,message){
    toastr.options ={
        // "closeButton": true,
        "progressBar": true,
        "maxOpened":1,
        "preventDuplicates": true,
        "positionClass": className
    }
    toastr.success(message);
}
function attempt(){
    modifiedDisplayMessage("new-success","successfukl");
    setTimeout(() => {
        toastr.clear();
    }, 1000);
    setTimeout(function() {
       
        modifiedDisplayMessage("new-error-two","not");
    }, 3000);

}