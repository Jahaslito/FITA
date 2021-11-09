@extends('layouts.admin')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
</head>
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
                </div>
            </div>

            {{-- <div class="col-md-7">
                <div class="card">
                    <div class="card-image">
                        <div id="morris-bar-chart"></div>
                    </div>
                    <div class="card-action">
                        <b> Bar Chart Example</b>
                    </div>
                </div>
            </div> --}}

            <div class="col-md-7">
                <div class="card" id="bar-chart-card">
                    <div class="card-image">
                        <canvas id="myBarChart" width="400"  style="display: block;"></canvas>
                    </div>
                    <div class="card-action">
                        <b> Bar Chart</b>
                         <input type="text" id="temperatureData" style="display: none">
                    </div>
                </div>
                <div class="card" id="pie-chart-card">
                    <div class="card-image">
                        <canvas id="myPieChart" width="400"  style="display: block;"></canvas>
                    </div>
                    <div class="card-action">
                        <b> Pie Chart</b>
                    </div>
                </div>
                <div class="card" id="line-chart-card">
                    <div class="card-image">
                        <canvas id="myLineChart" width="400" style="display: block;"></canvas>
                    </div>
                    <div class="card-action">
                        <b> Line Chart</b>
                    </div>
                </div>
                <div class="card-action" id="options">
                    <select id="chartType" style="display: block;">
                        <option value="bar" selected>Bar Chart</option>
                        <option value="pie" >Pie Chart</option>
                        <option value="line" >Line Chart</option>
                    </select>
                </div>

                <div class="card" id="grouped-bar-chart-card">
                    <div class="card-image">
                        <canvas id="myGroupedBarChart" width="400"  style="display: block;"></canvas>
                    </div>
                    <div class="card-action">
                        <b> Bar Chart</b>
                         <input type="text" id="temperatureData" style="display: none">
                    </div>
                </div>
            </div>


        </div>
                
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
    </div>

    </div>
    </div>
    <script src="{{asset('js/dashboard.js')}}"></script>
@endsection

