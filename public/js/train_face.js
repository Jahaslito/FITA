// variable that checks which option of photo upload is selected
//1. Direct upload of a photo
//2. Taking a photo using the webcam

//3. Use the profile Image
var uploadOption=1; 

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
capture.onclick = function() {
    cameraSensor.width = cameraView.videoWidth;
    cameraSensor.height = cameraView.videoHeight;
    cameraSensor.getContext("2d").drawImage(cameraView, 0, 0);
    cameraOutput.src = cameraSensor.toDataURL("image/webp");
    console.log(cameraOutput.src);
};

// Start the video stream when the button start camera is clicked
openCamera.onclick= function() {
    cameraStart();
};
// End the video stream when the button start camera is clicked
closeCamera.onclick=function () {
    cameraEnd();
};

takePhoto.onclick= function () {
    takePhotoContainer.classList.remove('hide-element');
    uploadPhotoContainer.classList.add('hide-element');
    profilePhotoContainer.classList.add('hide-element');
    uploadOption=2;
}
uploadPhoto.onclick= function () {
    uploadPhotoContainer.classList.remove('hide-element');
    takePhotoContainer.classList.add('hide-element');
    profilePhotoContainer.classList.add('hide-element');
    uploadOption=1;
}
profilePhoto.onclick = function () {
    profilePhotoContainer.classList.remove('hide-element');
    uploadPhotoContainer.classList.add('hide-element');
    takePhotoContainer.classList.add('hide-element');
    uploadOption=3;
}

clickUploadPhoto.onclick = function () {
    uploadedPhoto.click();
}

// Using Jquery and AJAX to make requests directly to the server
$(document).ready(function(){
    $("#train-button").click(function(){
        switch (uploadOption) {
            case 1:
                $("#uploaded-photo").val();
                let uploadedImage= $('#uploaded-photo')[0].files[0];
                // console.log(uploadedImage);
                let formData= new FormData();
                formData.append("uploaded-photo",uploadedImage);
                // console.log(uploadedImage);
                $.ajax({
                    url: '/train_face',
                    data:formData,
                    method: "post",
                    contentType: false,
                    processData: false,
                    success:function(result) {
                        console.log(result);
                    },
                    error:function(result){
                        console.log(result);
                    }
                });
                break;
            case 2:
            
                break;
            case 3:
            
                break;
            default:
                break;
        }
    });
    $("#identify-button").click(function(){
        console.log("called1");
        switch (uploadOption) {
            case 1:
                // $("#uploaded-photo").val();
                let uploadedImage= $('#uploaded-photo')[0].files[0];
                console.log(uploadedImage);
                let formData= new FormData();
                formData.append("uploaded-photo",uploadedImage);
                console.log("called");
                // console.log(uploadedImage);
                $.ajax({
                    url: '/identify_face',
                    data:formData,
                    method: "post",
                    contentType: false,
                    processData: false,
                    success:function(result) {
                        console.log(result);
                    },
                    error:function(result){
                        console.log(result);
                    }
                });
                break;
            case 2:
            
                break;
            case 3:
            
                break;
            default:
                break;
        }
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