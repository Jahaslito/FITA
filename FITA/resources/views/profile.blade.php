<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/37280917ff.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <title>Landing</title>
</head>
<body>
   
        <div id="top-bar">
            <h1>LOGO</h1>
            <div id="profile-box" class="right">
                <img src="{{asset('images/profile.jpg')}}" alt="Profile Photo">
                <p> {{ Auth::user()->name }}</p>
                <!-- <span>></span> -->
                <div class="dropdown">
                    <i class="fa fa-caret-down" id="dropdown-icon"></i>
                    <div class="dropdown-content">
                      <a href="#">Logout</a>                    
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
                        <p> {{ Auth::user()->name }}</p>
                        <p>122475</p>
                        <div id="image-div">
                            <img src="{{asset('images/profile.jpg')}}" alt="Profile Image">
                        </div>
                        <button id="image-button" class="button">Upload New Photo</button>
                        <p>Maximum allowed size is 1MB</p>
                    </div>
                    <div id="percentage-card" class="card">
                        <p>Profile Complition</p>
                        <p id="percentage">60%</p>
                        <div class="progress-bar">
                            <div class="progress-status"></div>
                        </div>
                    </div>
                </div>
                <div id="right-right-bar">
                    <div id="edit-information-card" class="card">
                        <h1>Edit Information</h1>
                        <div id="personal-details">
                            <h3>Personal Details</h3>
                            <form action="#" method="post">
                                <div class="form-left-hand">
                                    <div class="input">
                                        <label for="first-name">First Name</label>
                                        <input type="text" id="first-name" name="first_name">
                                    </div>
                                    <div class="input">
                                        <label for="last-name">Last Name</label>
                                        <input type="text" id="last-name" name="last_name">
                                    </div>
                                    <div class="input">
                                        <label for="phone-number">Phone Number</label>
                                        <input type="text" id="phone-number" name="phone_number" placeholder="+251">
                                    </div>
                                </div>
                                <div class="form-right-hand">
                                    <div class="input">
                                        <label for="address">Address</label>
                                        <input type="text" id="address" name="address">
                                    </div>
                                    <div class="input">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" id="dob" name="dob">
                                    </div>
                                    <div class="input" >
                                    <button type="submit" class="button save-button"> Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="change-password">
                            <h3>Change Password</h3>
                            <form action="#" method="post">
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
                                    <div class="input">
                                    <button type="submit" class="button save-button"> Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="account-setting">
                            <h3>Account Seeting</h3>
                            <form action="#" method="post">
                                <div class="form-left-hand">
                                    <div class="input">
                                        <label for="email">Email</label>
                                        <input type="text" id="email" name="email">
                                    </div>
                                    <div class="button-group">
                                    <button type="submit" class="button save-button"> Save Changes</button>
                                    <button type="submit" class="button" id="delete-button"> Delete Account</button>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
</body>
<script src="{{asset('js/common.js')}}"></script>
<script src="{{asset('js/profile.js')}}"></script>
</html>