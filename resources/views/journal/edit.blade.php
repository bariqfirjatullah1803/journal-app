@extends('layouts.app')

@section('content')
    <a href="{{ route('journal.index') }}">Back</a>
    <div class="card mb-3">
        <div class="card-header">
            <h1>Edit Journal</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('journal.update', ['journal' => $journal->id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="timing" class="form-label">Timing</label>
                    <select class="form-control" id="timing" name="timing">
                        <option value="before" @if($journal->timing == 'before') selected @endif>Sebelum Istirahat
                        </option>
                        <option value="after" @if($journal->timing == 'after') selected @endif>Sesudah Istirahat
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-control" id="category" name="category_id">
                        @foreach($categories as $item)
                            <option value="{{ $item->id }}"
                                    @if($item->id == $journal->category_id) selected @endif>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="coordinator" class="form-label">Coordinator</label>
                    <select class="form-control" id="coordinator" name="coordinator_id">
                        @foreach($coordinators as $item)
                            <option value="{{ $item->id }}"
                                    @if($item->id == $journal->coordinator_id) selected @endif>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description"
                              name="description">{{ $journal->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="target" class="form-label">Target</label>
                    <textarea class="form-control" id="target" name="target">{{ $journal->target }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="progress" @if($journal->status == 'progress') selected @endif>Belum Tercapai</option>
                        <option value="complete" @if($journal->timing == 'complete') selected @endif>Tercapai</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">Comment</label>
                    <textarea class="form-control" id="comment" name="comment">{{ $journal->comment }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
