{{--<p class="card-category" href="users" style="text-align: center; font-size: xx-large"> Number of Users => {{ $userCount }}</p>--}}

{{--<h3 class="card-title">{{ $userCount }}</h3>--}}
@extends('layouts.admin')
@section('title')
    Users | FITA
@endsection
@section('body')
    <div id="page-wrapper">
<head>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
</head>

{{--<h1 class="h1" styxle="color: #0e9f6e; text-align: center;">Users</h1>--}}
<div class="page-header">
    <div>
    <h1  style="color: #0e9f6e"><i class="fa fa-users"></i> Daily Record </h1>
    <hr>

<div class="table-responsive">
    <table id = "datatable" class="table table-bordered table-striped table-dark table-hover" style="margin-top: 30px;">
     
        <thead>
        <tr>
            
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Symptoms</th>
            <th>Question 2</th>
            <th>Question 3</th>
            <th>Question 4</th>
            <th>Temperature</th>
            <th>Date</th>
        </tr>
        </thead>

        <tbody>
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
                <td>{{ $dailyRecord->question_two }}</td>
                <td>{{ $dailyRecord->question_three}}</td>
                <td>{{ $dailyRecord->question_four}}</td>
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

<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
    }
    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    tr:nth-child(even){
        background-color: #0e9f6e;
    }
    html{
        overflow:auto;
    }
</style>

@section('script')

<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous">
</script>

<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv','excel','pdf',
            ]
        });
    });
</script>
    </div>
@endsection
