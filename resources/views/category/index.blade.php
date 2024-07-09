@extends('layouts.app')

@section('content')
    <h1>Category</h1>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>List Category</h5>
            <a href="{{ route('category.create') }}" class="btn btn-primary">Create New</a>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categories as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->name}}</td>
                        <td>{{ $item->created_at}}</td>
                        <td>{{ $item->updated_at}}</td>
                        <td>
                            <form action="{{ route('category.destroy', ['category' => $item->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('category.edit', ['category' => $item->id]) }}"
                                   class="btn btn-sm btn-warning">Edit</a>
                                <button type="submit" onclick="return confirm('are you sure?')"
                                        class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $categories->links() }}
        </div>
    </div>
@endsection
