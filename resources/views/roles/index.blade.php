{{-- \resources\views\roles\index.blade.php --}}
@extends('layouts.admin')

@section('title', '| Roles')

@section('body')
    <div id="page-wrapper">
    <head>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    </head>

    <div class="col-lg-10 col-lg-offset-1" style="margin-top: 100px; margin-left: 40px;">
        <h1 style="color: #0e9f6e"><i class="fa fa-key" style="color: black"></i> Roles

            <a href="{{ route('users.index') }}" class="btn btn-default pull-right">Users</a>
            <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a></h1>
        <hr>
        <div class="table-responsive">
            <table id = "datatable" class="table table-bordered table-striped table-green">
                <thead style="color: #0e9f6e">
                <tr>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Operation</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($roles as $role)
                    <tr>

                        <td>{{ $role->name }}</td>

                        <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                        <td>
                            <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-dark pull-left" style="margin-right: 3px;">Edit</a>

                            <!-- Button trigger modal -->
                            <button type="button" data-form-link="{{ route('roles.destroy', $role->id) }}"  class="btn btn-danger delete-role-btn">
                                DELETE
                            </button>
{{--                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}--}}
{{--                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}--}}
{{--                            {!! Form::close() !!}--}}

                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

        <a href="{{ URL::to('roles/create') }}" class="btn btn-success">Add Role</a>

    </div>

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
    </style>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').DataTable();
            $('.delete-role-btn').click(function() {
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
                    if (result.value) {
                        $.ajax({
                            url: deleteUrl,
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}"
                            }
                        }).then((res) => {
                            console.log(res);
                            window.location.reload(true);
                        }).catch((err) => {
                            console.error(err)
                        })
                    }
                })
            })
        });

    </script>
    </div>
@endsection
