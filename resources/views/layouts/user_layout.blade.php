<!DOCTYPE html>
<html lang="en">
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/37280917ff.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    <title>Landing</title>
    
</head>
<body>
    <div class="navbar">
        <p class="logo"></p>
        <div class="navbar-lists">
            <div class="lists" onclick="trainFace()">
                <p>Train Face</p>
            </div>
            <div class="lists" onclick="screeningData()">
                <p>Screening Data</p>
            </div>
            <div class="lists" onclick="profile()">
                <p>Profile</p>
            </div>
            <div id="profile-box" class="right">
                <img src="{{asset($profile_photo_path)}}" alt="Profile Photo">
                <p> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                <!-- <span>></span> -->
                <div class="dropdown">
                    <i class="fa fa-caret-down" id="dropdown-icon"></i>
                    <div class="dropdown-content" id="dropdown-id">
                        <a onclick="profile()" class="extra-nav">Profile</a>
                        <a class="extra-nav" onclick="screeningData()">Screening Data</a>
                        <a onclick="trainFace()" class="extra-nav">Train Face</a>
                        <a onclick="logout()">Logout</a>                
                    </div>
                </div> 
                
            </div>
        </div>
    </div>
@yield('content')
