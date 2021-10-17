
@extends('layouts.admin')
@section('title')
    Users | FITA
@endsection
@section('body')
    <div id="page-wrapper">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('css/daily_record.css')}}">
</head>

{{--<h1 class="h1" styxle="color: #0e9f6e; text-align: center;">Users</h1>--}}
<div class="page-header">
    <div>
    <h1  style="color: #0e9f6e"><i class="fa fa-users"></i> Daily Record </h1>
    <hr>
    <div class="filter">
        <div class="option">
            <label for="symptom">Symptom</label>
            <select name="symptom" id="symptom">
                <option value="not-selected" selected>Select Symptom</option>
                @foreach ($symptoms as $symptom)
                    <option value="{{$symptom->id}}">{{$symptom->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="option">
            <label for="date">Date</label>
           <input type="date" name="date" id="date" >
        </div>
        <div class="option">
            <label for="question">Question</label>
            <select name="question" id="question" onchange="questionFilterChange()">
                <option value="none" selected>Select Question</option>
                <option value="question-two">Question two</option>
                <option value="question-three">Question three</option>
                <option value="question-four">Question four</option>
            </select>
        </div>
        <div class="option answer">
            <label for="answer">Answer</label>
            <select name="answer" id="answer">
                <option value="no" selected>No</option>
                <option value="yes">Yes</option>
                <option value="maybe">Maybe</option>
            </select>
        </div>
    </div>
<div class="table-responsive">
    <table id = "datatable" class="table table-bordered table-striped table-dark table-hover" style="margin-top: 30px;">
     
        <thead>
        <tr>   
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Symptoms</th>
            <th title="Have you been in close physical contact in the last 14 days with anyone who is known to have laboratory-confirmed COVID-19?">Question 2</th>
            <th title="Have you been in close physical contact in the last 14 days with anyone who has any symptoms consistent with COVID-19?">Question 3</th>
            <th title="Have you traveled to places with high covid-19 incidences in the past 10 days?">Question 4</th>
            <th>Temperature</th>
            <th>Date</th>
        </tr>
        </thead>

        <tbody id="tbody">
        @foreach ($dailyRecords as $dailyRecord)
            <tr>

                <td>{{ $dailyRecord->first_name}}</td>
                <td>{{ $dailyRecord->last_name}}</td>
                <td>{{ $dailyRecord->email }}</td>
                @php
                    $symptoms= $dailyRecord->symptoms;
                    $symptomLists="";
                    foreach ($symptoms as $symptom) {
                        $symptomLists.=$symptom.",\n";
                    }
                @endphp
                <td>{{ $symptomLists}}</td>
                <td title="Have you been in close physical contact in the last 14 days with anyone who is known to have laboratory-confirmed COVID-19?">{{ $dailyRecord->question_two }}</td>
                <td title="Have you been in close physical contact in the last 14 days with anyone who has any symptoms consistent with COVID-19?">{{ $dailyRecord->question_three}}</td>
                <td title="Have you traveled to places with high covid-19 incidences in the past 10 days?">{{ $dailyRecord->question_four}}</td>
                <td>{{ $dailyRecord->temperature}}</td>

                <td>{{ $dailyRecord->created_at->format('F d, Y h:ia') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
    </div>
</div>
        @endsection

@section('script')

{{-- <script
    src="https://code.jquery.com/jquery-1.10.2.min.js"
    >
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> --}}
<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous">

</script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('js/daily_record.js')}}"></script>
    </div>
@endsection

