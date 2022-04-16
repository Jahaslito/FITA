
@extends('layouts.admin')
@section('title')
    Logs | FITA
@endsection
@section('body')
    <div id="page-wrapper">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('css/daily_record.css')}}">
</head>

{{--<h1 class="h1" styxle="color: #0e9f6e; text-align: center;">Users</h1>--}}
<div class="page-header">
    <div>
    <h1  style="color: #0e9f6e"><i class="fa fa-users"></i> Logs </h1>
    <hr>
    <table id="myTable" class="display" >
        <thead>
            <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
                @php
                    $userFullName= $users[$log->id]['first_name']." ".$users[$log->id]['last_name']; 
                @endphp
               <tr>
                <td>{{$userFullName}}</td>
                <td>{{$log->date}}</td>
                <td>{{$log->time}}</td>
               </tr>
            @endforeach
          {{-- @php
              $counter = -1;
          @endphp
          @foreach ($feedbacks as $feedback)
            <tr>
              @php
              $timestamp = strtotime($feedback->created_at);
              $time = date('h:i:s',$timestamp);
              $date = date('Y-m-d',$timestamp);
              $today = date('Y-m-d');
              $counter++;
              @endphp
  
              <td>{{$date}}</td>
              <td>{{$time}}</td>
              <td>{{$feedback->service_name}}</td>
              <td>{{$feedback->location_name}}</td>
              <td>{{$feedback->satisfaction_level}}</td>
              @php
                 $issueString= "";
                 $comma=0;
                 foreach($issues[$counter] as $issue){
                    if ($comma!=0) {
                       $issueString.=",  ";
                    }
                    $issueString.=$issue;
                    $comma++;
                 }
              @endphp
              <td>{{$issueString}}</td>
              <td>{{$feedback->status}}</td>
              <td><a href="/admin/feedback_detail/{{$feedback->id}}">details</a></td>
            </tr>
          @endforeach --}}
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
{{-- <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous">

</script> --}}
{{-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>  --}}
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> --}}

{{-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script src="{{asset('js/logs.js')}}"></script>
    </div>
@endsection

