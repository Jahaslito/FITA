<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/identify_face.css')}}">
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

    <div id="sub-container" class="card">

        <div id="take-photo-container" class=" flex ">


                <video id="camera_view" class="card" autoplay playsinline></video>
                <!-- Camera sensor -->
                <canvas id="camera_sensor" class="card hide-element"></canvas>
           
            <!-- Camera view -->
           
              <div class="camera-buttons">
                <button id="camera_open">Open Camera</button>
                <button id="camera_close" class="red-button" onclick="cameraEnd()">Close Camera</button>
              </div>
            
        </div>
        <button class="save" id="identify-button"> Identify</button>
    </div>

 </div>   
</body>
<script src="{{asset('js/identify_face.js')}}"></script>
<script src="{{asset('js/common.js')}}"></script>
</html>
@endsection