{{--<p class="card-category" href="users" style="text-align: center; font-size: xx-large"> Number of Users => {{ $userCount }}</p>--}}

{{--<h3 class="card-title">{{ $userCount }}</h3>--}}
@extends('layouts.admin')
@section('title')
    Dashboard | FITA
@endsection

@section('body')
    <div id="page-wrapper">
        <div class="header">
            <h1 class="page-header">
                Dashboard
            </h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Dashboard</a></li>
                <li class="active">Data</li>
            </ol>

        </div>
        <div id="page-inner">

            <div class="dashboard-cards">
                <div class="row">

                    <div class="col-xs-12 col-sm-6 col-md-3">

                        <div class="card horizontal cardIcon waves-effect waves-dark">
                            <div class="card-image orange">
                                <i class="material-icons dp48">equalizer</i>
                            </div>
                            <div class="card-stacked orange">
                                <div class="card-content">
                                    <h3>{{$temp}}</h3>
                                </div>
                                <div class="card-action">
                                    <strong>Daily Average Temperature</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">

                        <div class="card horizontal cardIcon waves-effect waves-dark">
                            <div class="card-image blue">
                                <i class="material-icons dp48">equalizer</i>
                            </div>
                            <div class="card-stacked blue">
                                <div class="card-content">
                                    <h3>{{$average}}</h3>
                                </div>
                                <div class="card-action">
                                    <strong>Average Temperature</strong>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">

                        <div class="card horizontal cardIcon waves-effect waves-dark">
                            <div class="card-image green">
                                <i class="material-icons dp48">supervisor_account</i>
                            </div>
                            <div class="card-stacked green">
                                <div class="card-content">
                                    <h3>{{$userCount}}</h3>
                                </div>
                                <div class="card-action">
                                    <strong>Users</strong>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /. ROW  -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7">
                    <div class="cirStats">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="card-panel text-center">
                                    <h4>No. of Visits</h4>
                                    <div class="easypiechart" id="easypiechart-red" data-percent="46" ><span class="percent">{{$userCount}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.row-->
                {{--                <div class="col-xs-12 col-sm-12 col-md-5">--}}
                {{--                    <div class="row">--}}
                {{--                        <div class="col-xs-12">--}}
                {{--                            <div class="card">--}}
                {{--                                <div class="card-image donutpad">--}}
                {{--                                    <div id="morris-donut-chart"></div>--}}
                {{--                                </div>--}}
                {{--                                <div class="card-action">--}}
                {{--                                    <b>Donut Chart </b>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div><!--/.row-->--}}
            </div>


            {{--            <div class="row">--}}
            {{--                <div class="col-md-5">--}}
            {{--                    <div class="card">--}}
            {{--                        <div class="card-image">--}}
            {{--                            <div id="morris-line-chart"></div>--}}
            {{--                        </div>--}}
            {{--                        <div class="card-action">--}}
            {{--                            <b>Line Chart</b>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}

            {{--                </div>--}}

            <div class="col-md-7">
                <div class="card">
                    <div class="card-image">
                        <div id="morris-bar-chart"></div>
                    </div>
                    <div class="card-action">
                        <b> Bar Chart Example</b>
                    </div>
                </div>
            </div>

        </div>



        {{--            <div class="row">--}}
        {{--                <div class="col-xs-12">--}}
        {{--                    <div class="card">--}}
        {{--                        <div class="card-image">--}}
        {{--                            <div id="morris-area-chart"></div>--}}
        {{--                        </div>--}}
        {{--                        <div class="card-action">--}}
        {{--                            <b>Area Chart</b>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}

        {{--            </div>--}}
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
    </div>

    </div>
    </div>
@endsection
{{--<head>--}}
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">--}}
{{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">--}}
{{--</head>--}}

{{--<h1 class="h1" style="color: #0e9f6e; text-align: center;">Users</h1>--}}
{{--<div class="table-responsive">--}}
{{--    <table id = "datatable" class="table table-bordered table-striped table-dark table-hover" style="margin-top: 30px;">--}}
{{--        <caption>List of users</caption>--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>Name</th>--}}
{{--            <th>Email</th>--}}
{{--            <th>Date/Time Added</th>--}}
{{--            <th>Address</th>--}}
{{--            <th>User Role</th>--}}
{{--            <th>Operations</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}

{{--        <tbody>--}}
{{--        @foreach ($users as $user)--}}
{{--            <tr>--}}

{{--                <td>{{ $user->name }}</td>--}}
{{--                <td>{{ $user->email }}</td>--}}
{{--                <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>--}}
{{--                <td>{{ $user->address }}</td>--}}
{{--                <td>{{  $user->roles()->pluck('name')->implode(' ,') }}</td>--}}
{{--                <td>--}}
{{--                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-dark pull-left" style="margin-right: 30px; margin-left: 30px;">Edit</a>--}}

{{--                    <!-- Button trigger modal -->--}}
{{--                    <button type="button" data-form-link="{{ route('users.destroy', $user->id) }}" class="btn btn-danger delete-user-btn">--}}
{{--                        DELETE--}}
{{--                    </button>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--</div>--}}

{{--<style>--}}
{{--    table {--}}
{{--        font-family: arial, sans-serif;--}}
{{--        border-collapse: collapse;--}}
{{--    }--}}
{{--    td, th {--}}
{{--        border: 1px solid #dddddd;--}}
{{--        text-align: left;--}}
{{--        padding: 8px;--}}
{{--    }--}}
{{--    tr:nth-child(even){--}}
{{--        background-color: #0e9f6e;--}}
{{--    }--}}
{{--</style>--}}
{{--@section('script')--}}
{{--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>--}}
{{--<script--}}
{{--    src="https://code.jquery.com/jquery-3.4.1.min.js"--}}
{{--    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="--}}
{{--    crossorigin="anonymous">--}}

{{--</script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>--}}
{{--<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>--}}
{{--<script type="text/javascript">--}}
{{--    $(document).ready(function() {--}}
{{--        $('#datatable').DataTable();--}}
{{--        $('.delete-user-btn').click(function() {--}}
{{--            const deleteUrl = $(this).attr('data-form-link');--}}

{{--            Swal.fire({--}}
{{--                title: 'Are you sure?',--}}
{{--                text: "You won't be able to revert this!",--}}
{{--                icon: 'warning',--}}
{{--                showCancelButton: true,--}}
{{--                confirmButtonColor: '#3085d6',--}}
{{--                cancelButtonColor: '#d33',--}}
{{--                confirmButtonText: 'Yes, delete it!'--}}
{{--            }).then((result) => {--}}
{{--                console.log('test 1');--}}
{{--                if (result.value) {--}}
{{--                    console.log('test 2');--}}
{{--                    $.ajax({--}}
{{--                        url: deleteUrl,--}}
{{--                        type: 'DELETE',--}}
{{--                        data: {--}}
{{--                            "_token": "{{ csrf_token() }}"--}}
{{--                        }--}}
{{--                    }).then((res) => {--}}
{{--                        console.log('test 3');--}}
{{--                        console.log(res);--}}
{{--                        window.location.reload(true);--}}
{{--                    }).catch((err) => {--}}
{{--                        console.error(err)--}}
{{--                    })--}}
{{--                }--}}
{{--            })--}}
{{--        })--}}
{{--    });--}}

{{--</script>--}}
{{--@endsection--}}
