<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://kit.fontawesome.com/37280917ff.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <title>Landing</title>
</head>
<body>
   
        <div id="top-bar">
            <h1>LOGO</h1>
            <div id="profile-box" class="right">
                <img src="{{asset('images/profile.jpg')}}" alt="Profile Photo">
                <p> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                <!-- <span>></span> -->
                <div class="dropdown">
                    <i class="fa fa-caret-down" id="dropdown-icon"></i>
                    <div class="dropdown-content">
                      <a onclick="logout()">Logout</a>                    
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
                        <p class="list">Profile</p>
                    </div>
                    <div class="side-bar-list">
                        <i class="fas fa-clipboard-list fa-2x"></i>
                        <p class="list">Screening Data</p>
                    </div>
                    <div class="side-bar-list">
                        <i class="fas fa-camera fa-2x"></i>
                        <p class="list">Biometric</p>
                    </div>
                </div>
            </aside>
            <div id="right-bar">
                <i class="fas fa-align-justify fa-2x" id="folder" onclick="openOverlay()"></i>
                <div id="right-left-bar">
                    <div id="profile-photo-card" class="card">
                        <p> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                        <p>122475</p>
                        <div id="image-div">
                            <img src="{{asset('images/profile.jpg')}}" alt="Profile Image">
                        </div>
                        <button id="image-button" class="button">Upload Photo</button>
                        <p id="extra-info">Maximum allowed size is 1MB</p>
                    </div>
                    {{-- <div id="percentage-card" class="card">
                        <p>Profile Complition</p>
                        <p id="percentage">60%</p>
                        <div class="progress-bar">
                            <div class="progress-status"></div>
                        </div>
                    </div> --}}
                </div>
                <div id="right-right-bar">
                    <div id="edit-information-card" >
                        <h1>Edit Information</h1>
                        <div id="personal-details" class="card">
                            <h3>Personal Details</h3>
                            <div class="form">
                                <div class="form-left-hand">
                                    <div class="input">
                                        <label for="first-name">First Name</label>
                                        <input type="text" id="first-name" name="first_name" value="{{Auth::user()->first_name}}">
                                    </div>
                                    <div class="input">
                                        <label for="last-name">Last Name</label>
                                        <input type="text" id="last-name" name="last_name" value="{{Auth::user()->last_name}}">
                                    </div>
                                    <div class="input">
                                        <label for="phone-number">Phone Number</label>
                                        <input type="text" id="phone-number" name="phone_number" placeholder="+251" value="{{ Auth::user()->phone_number}}">
                                    </div>
                                </div>
                                <div class="form-right-hand">
                                    <div class="input">
                                        <label for="address">Address</label>
                                        <input type="text" id="address" name="address" value="{{ Auth::user()->address}}">
                                    </div>
                                    <div class="input">
                                        <label for="date-of-birth">Date of Birth</label>
                                        <input type="date" id="date-of-birth" name="date_of_birth" value="{{ Auth::user()->date_of_birth}}">
                                    </div>
                                    <div id="personal-detail-message"></div>
                                    <div class="input" >
                                    <button type="submit" id="update_personal_details" class="button save-button"> Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="change-password" class="card">
                            <h3>Change Password</h3>
                            <div class="form">
                                <div class="form-left-hand">
                                    <div class="input">
                                        <label for="current-password">Current Password</label>
                                        <input type="password" id="current-password" name="current_password">
                                    </div>
                                    <div class="input">
                                        <label for="new-password">New Password</label>
                                        <input type="password" id="new-password" name="new_password">
                                    </div>
                                </div>
                                <div class="form-right-hand">
                                    <div class="input">
                                        <label for="verify-password">Verify Password</label>
                                        <input type="password" id="verify-password" name="verify_password">
                                    </div>
                                    <div id="change-password-message"></div>
                                    <div class="input">
                                    <button type="submit" id="change_password" class="button save-button"> Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="account-setting" class="card">
                            <h3>Account Setting</h3>
                            <div class="form">
                                <div class="form-left-hand">
                                    <div class="input">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" value="{{Auth::user()->email}}">
                                    </div>
                                    <div class="button-group">
                                        <div id="change-email-message"></div>
                                    <button type="submit" id="change_email" class="button save-button"> Save Changes</button>
                                    {{-- <button type="submit" class="button" id="delete-button"> Delete Account</button> --}}
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
</body>
<script src="{{asset('js/common.js')}}"></script>
<script src="{{asset('js/profile.js')}}"></script>
</html>