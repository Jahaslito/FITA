<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/train_face.css')}}">
    <script src="https://kit.fontawesome.com/37280917ff.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Train Face</title>
</head>
<body>
@php 
$profile_photo_path= Auth::user()->profile_photo_path==null ? 'images/default_photo.jpg': '/storage/photos/'.Auth::user()->profile_photo_path;
@endphp
 @extends('layouts.user_layout')
 @section('content')

 <div id="main-container">
    <div class="buttons" >
        <button id="upload-photo">Upload Photo</button>
        <button id="take-photo">Take Photo</button>
        <button id="profile-photo">Use Profile Photo</button>
    </div>
    <div id="sub-container" class="card">
        <div id="upload-photo-container" class="flex hide-element">
            <img src="{{asset('images/default_photo.jpg')}}" id="uploaded-image-holder" alt="">
            <input type="file" id="uploaded-photo" class="hide-element" id="image-upload" onchange="changeImage(this)">
            <button id="click-upload-photo">Upload Photo</button>
        </div>
        <div id="take-photo-container">

            <div id="display-boxes">
                <video id="camera_view" class="card" autoplay playsinline></video>
                <!-- Camera sensor -->
                <canvas id="camera_sensor" class="card"></canvas>
            </div>
            <!-- Camera view -->
           
              <div class="camera-buttons">
                <button id="camera_open">Open Camera</button>
                <button id="camera_trigger" class="darg-green">Capture</button>
                <button id="camera_close" class="red-button" onclick="cameraEnd()">Close Camera</button>
              </div>
            
        </div>
        <div id="profile-photo-container" class="hide-element flex">
            <img src="{{asset($profile_photo_path)}}" alt="">
        </div>
        <button class="save" id="train-button"> Train</button>
    </div>

 </div>   
</body>
<script src="{{asset('js/train_face.js')}}"></script>
<script src="{{asset('js/common.js')}}"></script>
<script src="ihttps://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</html>
@endsection