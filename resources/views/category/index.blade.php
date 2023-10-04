@extends('layouts.app-master')
@section('title', 'Categories')
@section('content')
    <h1>All Categories</h1>
    <a href="{{ route('cats.create') }}" class="btn btn-sm btn-success">Add<i class="material-icons">add</i></a>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Image</th>
                <th>Child</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cats as $key => $cat)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $cat->name }}</td>
                    <td><img src="{{ url('/uploads/' . $cat->image) }}" style="width: 50px;height:50px" alt=""></td>
                    <td>
                        <a href="{{ route('categories.subcategory.index',$cat) }}" class="btn btn-sm btn-info"><i class="material-icons">visibility</i> </a>
                    <td>
                        <a href="{{ route('cats.edit', $cat->id) }}" class="btn btn-sm btn-warning"><i
                                class="material-icons">edit</i></a>

                        <form action="{{ route('cats.destroy', $cat->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="material-icons">delete</i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
