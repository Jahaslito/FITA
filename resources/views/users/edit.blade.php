@extends('layouts.admin')
@section('title')
    Edit Users | FITA
@endsection
@section('body')
    <div id="page-wrapper">
        <div class="page-header">
            <div id="page-inner">
 <div class='col-lg-4 col-lg-offset-4'>
     <div class="page-header">
         <div id="page-inner">
        <h1 style="color: #0e9f6e"><i class='fa fa-user'></i> Edit {{$user->name}}</h1>
        <hr>

        {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}



        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', null, array('class' => 'form-control')) }}
        </div>

        <h5><b>Give Role</b></h5>

        <div class='form-group form-check-input'>
            @foreach ($roles as $role)
                {{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}
                {{ Form::label($role->name, ucfirst($role->name)) }}<br>

            @endforeach
        </div>
             <div class="form-group" style="margin-top: 70px">

        {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}
             </div>
        {{ Form::close() }}

    </div>
    </div>
 </div>
    </div>
        </div>
    </div>

    <style>
        [type="checkbox"]:not(:checked),[type="checkbox"]:checked{position: unset;opacity: unset;}
        label:first-child{
            color:#0e9f6e;
            font-size: large;
        }
    </style>
@endsection
