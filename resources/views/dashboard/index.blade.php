@extends('layouts.app')

@section('content')
    <h1>Dashboard</h1>
    @if(auth()->user()->role == 'employee')
        <div class="card mb-3">
            <div class="card-header">
                <h5>Form Add Journal</h5>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('journal.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="timing" class="form-label">Timing</label>
                                <select class="form-control" id="timing" name="timing">
                                    <option value="before">Sebelum Istirahat</option>
                                    <option value="after">Sesudah Istirahat</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-control" id="category" name="category_id">
                                    @foreach($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="coordinator" class="form-label">Coordinator</label>
                                <select class="form-control" id="coordinator" name="coordinator_id">
                                    @foreach($coordinators as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="progress">Belum Tercapai</option>
                                    <option value="complete">Tercapai</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="target" class="form-label">Target</label>
                        <textarea class="form-control" id="target" name="target"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea class="form-control" id="comment" name="comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5>List Journal {{ now()->dayName }}</h5>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    @if(auth()->user()->role == 'coordinator')
                        <th scope="col">Employee</th>
                    @endif
                    <th scope="col">Timing</th>
                    <th scope="col">Category</th>
                    <th scope="col">Coordinator</th>
                    <th scope="col">Description</th>
                    <th scope="col">Target</th>
                    <th scope="col">Status</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Last Modified</th>
                    @if(auth()->user()->role == 'employee')
                        <th scope="col">Action</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($journals as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        @if(auth()->user()->role == 'coordinator')
                            <td>{{ $item->employee->name }}</td>
                        @endif
                        <td>{{ ($item->timing == 'before') ? 'Sebelum' : 'Sesudah' }} Istirahat</td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->coordinator->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->target }}</td>
                        <td>{{ ($item->status == 'progress') ? 'Belum' :  ''}} Tercapai</td>
                        <td>{{ $item->comment }}</td>
                        <td>{{ $item->updated_at }}</td>
                        @if(auth()->user()->role == 'employee')
                            <td>
                                <form action="{{ route('journal.destroy', ['journal' => $item->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('journal.edit', ['journal' => $item->id]) }}"
                                       class="btn btn-sm btn-warning">Edit</a>
                                    <button type="submit" onclick="return confirm('are you sure?')"
                                            class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $journals->links() }}
        </div>
    </div>
@endsection
