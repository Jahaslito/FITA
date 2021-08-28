{{--<p class="card-category" href="users" style="text-align: center; font-size: xx-large"> Number of Users => {{ $userCount }}</p>--}}

{{--<h3 class="card-title">{{ $userCount }}</h3>--}}
@extends('layouts.admin')
@section('title')
    Users | FITA
@endsection
@section('body')
    <div id="page-wrapper">
<head>
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
{{--    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

{{--<h1 class="h1" style="color: #0e9f6e; text-align: center;">Users</h1>--}}
<div class="page-header">
    <div>
    <h1  style="color: #0e9f6e"><i class="fa fa-users"></i> Daily Record </h1>
    <hr>
@php
    
@endphp
<div class="table-responsive">
    <table id = "datatable" class="table table-bordered table-striped table-dark table-hover" style="margin-top: 30px;">
        <caption>List of users</caption>
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
    <button id="Download">Download</button>
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
        overflow: hidden;
    }
</style>

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous">

</script>
{{--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>--}}
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="ihttps://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

            @if(Session::has('success'))
                <script>
                toastr.options ={
                "closeButton": true,
                "progressBar": true,
                "maxOpened":1,
                    "preventDuplicates": true
            }
            toastr.success("{{Session::get('success')}}");
                </script>
            @endif
            @if(Session::has('info'))
                <script>
                        toastr.options = {
                        "closeButton": true,
                        "progressBar": false,
                    }
                    toastr.info("{{Session::get('info')}}");
                </script>
            @endif

<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'Download',
            ]
        });
        table.buttons().container()
            .appendTo($('.col-sm-6:eq(0)', table.table().container()));

        $('.delete-user-btn').click(function() {
            const deleteUrl = $(this).attr('data-form-link');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                console.log('test 1');
                if (result.value) {
                    console.log('test 2');
                    $.ajax({
                        url: deleteUrl,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        }
                    }).then((res) => {
                        console.log('test 3');
                        console.log(res);
                        window.location.reload(true);
                    }).catch((err) => {
                        console.error(err)
                    })
                }
            })
        })
        // $('.disable-user-btn').click(function() {
        //     console.log('working');
        //     iziToast.show({
        //         title: 'Hey',
        //         message: 'What would you like to add?'
        //     });
        // })
    });

</script>
    </div>
@endsection
