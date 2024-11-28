@extends('layouts.admin.dashboard')
@section('content')
    <div class="container">
        <div class="page-inner">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
            <a class="btn btn-success" href="{{ route('admin.user.manageruser.create') }}">Thêm User</a>
            <table class="table table-hover table-bordered mt-3">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td class="d-flex" style="gap: 10px">
                                <a href="" class="btn btn-success">View</a>
                                <a href="" class="btn btn-warning">Update</a>
                                <a href="" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
