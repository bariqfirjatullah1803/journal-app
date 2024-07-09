@extends('layouts.app')

@section('content')
    <a href="{{ route('category.index') }}">Back</a>
    <div class="card">
        <div class="card-header">
            <h1>Form Edit Category</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('category.update', ['id' => $category->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="category-name" class="form-label">Category Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="category-name" name="name" value="{{ $category->name }}">
                    @error('name')
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
