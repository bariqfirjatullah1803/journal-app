@extends('layouts.app')

@section('content')
    <h1>User</h1>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4>List of Users</h4>
            <a href="{{ route('user.create') }}" class="btn btn-primary">Create New</a>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
@endsection
