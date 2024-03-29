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
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
    <title>Landing</title>
</head>
<body>
@php 
$profile_photo_path= Auth::user()->profile_photo_path==null ? 'images/default_photo.jpg': '/storage/photos/'.Auth::user()->profile_photo_path;
@endphp
@extends('layouts.user_layout')
@section('content')
        <div id="main">
            <div id="right-bar">
                <h2>COVID-19 Screening Data</h2>
                <div class="date-display">
                    <p>Date</p>
                    <p id="date">{{now()->format('F')}} {{now()->format('d')}}, {{now()->format('Y')}}</p>
                </div>
                <div id="form-box" class="card">
                    <form action="#" id="screening-data-form">
                        <div class="question" id="first-question">
                            <p class="label">Question 1</p>
                            <p class="question">Check one or more of the following symptoms if you have experienced them
                                in the past 48 hours.</p>
                            <div class="alternatives-list">
                                @foreach($symptoms as $symptom) 
                                <div class="alternatives-list-item">
                                    <input type="checkbox" name="{{str_replace(' ', '', $symptom->name)}}" id="{{$symptom->name}}" value="{{$symptom->id}}">
                                    <label for="{{$symptom->name}}">{{$symptom->name}}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="question" id="second-question">
                            <p class="label">Question 2</p>
                            <p class="question">Have you been in close physical contact in the last 14 days with anyone who is known to have laboratory-confirmed COVID-19?</p>
                            <div class="alternatives-list">
                                <div class="alternatives-list-item">
                                    <input type="radio" id="positive_contact_w_infected" name="question_two" value="yes">
                                    <label for="positive_contact_w_infected">Yes</label>
                                </div>
                                <div class="alternatives-list-item">
                                    <input type="radio" id="negative_contact_w_infected" name="question_two" value="no">
                                    <label for="negative_contact_w_infected">No</label>
                                </div>
                                <div class="alternatives-list-item">
                                    <input type="radio" id="cynical_contact_w_infected" name="question_two" value="maybe">
                                    <label for="cynical_contact_w_infected">Maybe</label>
                                </div>
                            </div>
                        </div>
                        <div class="question" id="third-question">
                            <p class="label">Question 3</p>
                            <p class="question">Have you been in close physical contact in the last 14 days with anyone who has any symptoms consistent with COVID-19?</p>
                            <div class="alternatives-list">
                                <div class="alternatives-list-item">
                                    <input type="radio" id="positive_contact_w_symptom" name="question_three" value="yes">
                                    <label for="positive_contact_w_symptom">Yes</label>
                                </div>
                                <div class="alternatives-list-item">
                                    <input type="radio" id="negative_contact_w_symptom" name="question_three" value="no">
                                    <label for="negative_contact_w_symptom">No</label>
                                </div>
                                <div class="alternatives-list-item">
                                    <input type="radio" id="cynical_contact_w_symptom" name="question_three" value="maybe">
                                    <label for="cynical_contact_w_symptom">Maybe</label>
                                </div>
                            </div>
                        </div>
                        <div class="question" id="fourth-question">
                            <p class="label">Question 4</p>
                            <p class="question">Have you traveled to places with high covid-19 incidences in the past 10 days?</p>
                            <div class="alternatives-list">
                                <div class="alternatives-list-item">
                                    <input type="radio" id="positive_traveled" name="question_four" value="yes">
                                    <label for="positive_traveled">Yes</label>
                                </div>
                                <div class="alternatives-list-item">
                                    <input type="radio" id="negative_traveled" name="question_four" value="no">
                                    <label for="negative_traveled">No</label>
                                </div>
                                <div class="alternatives-list-item">
                                    <input type="radio" id="cynical_traveled" name="question_four" value="maybe">
                                    <label for="cynical_traveled">Maybe</label>
                                </div>
                            </div>
                            <div id="response_message">

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
<script src="ihttps://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</html>
@endsection
