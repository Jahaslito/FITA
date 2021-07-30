{{-- \resources\views\permissions\create.blade.php --}}
@extends('layouts.admin')

@section('title', '| Create Permission')

@section('body')

<body>
    <div id="page-wrapper">

    <div class='col-lg-4 col-lg-offset-4'>

        <h1><i class='fa fa-key'></i> Add Permission</h1>
        <br>

        {{ Form::open(array('url' => 'permissions')) }}

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', '', array('class' => 'form-control')) }}
        </div><br>
        @if(!$roles->isEmpty())
        <h4>Assign Permission to Roles</h4>

        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach
        @endif
        <br>
        {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>
    </div>
</body>

{{--<style>--}}
{{--    legend{--}}
{{--        width: 500px;--}}
{{--        margin-left: 400px;--}}
{{--        border: solid;--}}
{{--        margin-top: 40px;--}}
{{--    }--}}
{{--    html{--}}
{{--        text-align: center;--}}
{{--        /*background-image: "/public/storage/img/logo.jpeg";*/--}}
{{--    }--}}
{{--</style>--}}
@endsection


