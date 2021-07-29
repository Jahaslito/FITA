<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/37280917ff.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>@yield('title')</title>
</head>
<body>


@php
    $profile_photo_path= Auth::user()->profile_photo_path==null ? 'images/default_photo.jpg': '/storage/photos/'.Auth::user()->profile_photo_path;
@endphp
<div id="top-bar">
    <h1>LOGO</h1>
    <div id="profile-box" class="right">
        <img src="{{asset($profile_photo_path)}}" alt="Profile Photo">
        <p> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
        <!-- <span>></span> -->
        <div class="dropdown">
            <i class="fa fa-caret-down" id="dropdown-icon"></i>
            <div class="dropdown-content">
                <a  onclick="logout()">Logout</a>
            </div>
        </div>

    </div>
</div>
<div id="main">
    <aside id="side-bar" class="overlay">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="overlay-content">
            <div class="side-bar-list">
                <i class="fas fa-user-circle fa-2x"></i>
                <p class="list" onclick="profile()">Profile</p>
            </div>
            <div class="side-bar-list">
                <i class="fas fa-clipboard-list fa-2x"></i>
                <p class="list" onclick="screeningData()">Screening Data</p>
            </div>
            {{-- <div class="side-bar-list">
                <i class="fas fa-camera fa-2x"></i>
                <p class="list" onclick="biometric()">Biometric</p>
            </div> --}}
        </div>
    </aside>
    @yield('content')
</div>
<script src="{{asset('js/common.js')}}"></script>
<script src="{{asset('js/landing.js')}}"></script>
</body>
</html>
