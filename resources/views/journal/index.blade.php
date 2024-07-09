@extends('layouts.app')

@section('content')
    <h1>Journal</h1>
    <div class="card">
        <div class="card-header">
            <h5>List All Journal</h5>
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
