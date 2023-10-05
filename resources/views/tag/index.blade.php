@extends('layouts.app-master')
@section('title', 'Tags')
@section('content')


    <h2>All Tags</h2>
    <a href="{{ route('tags.create') }}" class="btn btn-sm btn-success">Create Tag <i class="material-icons">add</i></a>

    <div class="row">
        <table class="table table-bordered table-striped my-5">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $key => $tag)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>
                            <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-sm btn-warning"><i
                                    class="material-icons">edit</i></a>
                            <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="material-icons">delete</i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
