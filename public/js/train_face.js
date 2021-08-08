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
}
uploadPhoto.onclick= function () {
    uploadPhotoContainer.classList.remove('hide-element');
    takePhotoContainer.classList.add('hide-element');
    profilePhotoContainer.classList.add('hide-element');
}
profilePhoto.onclick = function () {
    profilePhotoContainer.classList.remove('hide-element');
    uploadPhotoContainer.classList.add('hide-element');
    takePhotoContainer.classList.add('hide-element');
}

clickUploadPhoto.onclick = function () {
    uploadedPhoto.click();
}
