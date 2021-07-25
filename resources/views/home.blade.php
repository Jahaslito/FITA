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
                <h2>COVID-19 Screening Data</h2>
                <div class="date-display">
                    <p>Date</p>
                    <p id="date">{{now()->format('F')}} {{now()->format('d')}}, {{now()->format('Y')}}</p>
                </div>
                <div id="form-box">
                    <form action="#">
                        <div class="question" id="first-question">
                            <p class="label">Question 1</p>
                            <p class="question">Check one or more of the following symptoms if you have experienced them
                                in the past 48 hours.</p>
                            <div class="alternatives-list">
                                <div class="alternatives-list-item">
                                    <input type="checkbox" name="fever" id="fever" value="Fever or chills">
                                    <label for="fever">Fever or chills</label>
                                </div>
                                <div class="alternatives-list-item">
                                    <input type="checkbox" name="breathShortness" id="breathShortness" value="Shortness of breath or difficulty breathing">
                                    <label for="breathShortness">Shortness of breath or difficulty breathing</label>
                                </div>
                                <div class="alternatives-list-item">
                                    <input type="checkbox" name="dryCough" id="dryCough" value="Dry cough">
                                    <label for="dryCough">Dry cough</label>
                                </div>
                                <div class="alternatives-list-item">
                                    <input type="checkbox" name="soreThroat" id="soreThroat" value="Sore throat">
                                    <label for="soreThroat">Sore throat</label>
                                </div>
                                <div class="alternatives-list-item">
                                    <input type="checkbox" name="runningNose" id="runningNose" value="Congestion or runny nose">
                                    <label for="runningNose">Congestion or runny nose</label>
                                </div>
                                <div class="alternatives-list-item">
                                    <input type="checkbox" name="fatigue" id="fatigue" value="Fatigue">
                                    <label for="fatigue">Fatigue</label>
                                </div>
                                <div class="alternatives-list-item">
                                    <input type="checkbox" name="aches" id="aches" value="Head or muscle aches">
                                    <label for="aches">Head or muscle aches</label>
                                </div>
                                <div class="alternatives-list-item">
                                    <input type="checkbox" name="others" id="others" value="Nausea, diarrhea, vomiting">
                                    <label for="others">Nausea, diarrhea, vomiting</label>
                                </div>
                                <div class="alternatives-list-item">
                                    <input type="checkbox" name="none" id="none" value="none">
                                    <label for="fatigue">None</label>
                                </div>
                            </div>
                        </div>
                        <div class="question" id="second-question">
                            <p class="label">Question 2</p>
                            <p class="question">Have you been in close physical contact in the last 14 days with anyone who is known to have laboratory-confirmed COVID-19?</p>
                            <div class="alternatives-list">
                                <div class="alternatives-list-item">
                                    <input type="radio" id="positive_contact_w_infected" name="contact_w_infected" value="yes">
                                    <label for="positive_contact_w_infected">Yes</label>
                                </div>
                                <div class="alternatives-list-item">
                                    <input type="radio" id="negative_contact_w_infected" name="contact_w_infected" value="no">
                                    <label for="negative_contact_w_infected">No</label>
                                </div>
                                <div class="alternatives-list-item">
                                    <input type="radio" id="cynical_contact_w_infected" name="contact_w_infected" value="maybe">
                                    <label for="cynical_contact_w_infected">Maybe</label>
                                </div>
                            </div>
                        </div>
                        <div class="question" id="third-question">
                            <p class="label">Question 3</p>
                            <p class="question">Have you been in close physical contact in the last 14 days with anyone who has any symptoms consistent with COVID-19?</p>
                            <div class="alternatives-list">
                                <div class="alternatives-list-item">
                                    <input type="radio" id="positive_contact_w_symptom" name="contact_w_symptom" value="yes">
                                    <label for="positive_contact_w_symptom">Yes</label>
                                </div>
                                <div class="alternatives-list-item">
                                    <input type="radio" id="negative_contact_w_symptom" name="contact_w_symptom" value="no">
                                    <label for="negative_contact_w_symptom">No</label>
                                </div>
                                <div class="alternatives-list-item">
                                    <input type="radio" id="cynical_contact_w_symptom" name="contact_w_symptom" value="maybe">
                                    <label for="cynical_contact_w_symptom">Maybe</label>
                                </div>
                            </div>
                        </div>
                        <div class="question" id="fourth-question">
                            <p class="label">Question 4</p>
                            <p class="question">Have you traveled to places with high covid-19 incidences in the past 10 days?</p>
                            <div class="alternatives-list">
                                <div class="alternatives-list-item">
                                    <input type="radio" id="positive_traveled" name="traveled" value="yes">
                                    <label for="positive_traveled">Yes</label>
                                </div>
                                <div class="alternatives-list-item">
                                    <input type="radio" id="negative_traveled" name="traveled" value="no">
                                    <label for="negative_traveled">No</label>
                                </div>
                                <div class="alternatives-list-item">
                                    <input type="radio" id="cynical_traveled" name="traveled" value="maybe">
                                    <label for="cynical_traveled">Maybe</label>
                                </div>
                            </div>
                        </div>
                        <div class="buttons-container">
                            <button class="button" id="submit" type="submit">Next</button>
                            <button class="button" id="back" type="button">Back</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

</body>
<script src="{{asset('js/common.js')}}"></script>
<script src="{{asset('js/landing.js')}}"></script>
</html>
