@extends('layouts.app-master')
@section('title', 'Sub Categories')
@section('content')
    <h1 class="my-3">All Sub Categories</h1>
    <div class="my-3">
        <a href="{{ route('cats.index') }}" class="btn btn-secondary rounded-1"><i class="material-icons">arrow_back</i></a>
        <a href="{{ route('categories.subcategory.create', $cat->id) }}" class="btn btn-sm btn-success">Create Sub Cat<i
                class="material-icons">add</i></a>

    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($cat->subcats as $key => $cat)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $cat->name }}</td>
                    <td><img src="{{ url('/uploads/subcategory/' . $cat->image) }}" style="width: 50px;height:50px"
                            alt=""></td>
                    <td>
                        <a href="{{ route('subcategory.show', $cat->id) }}" class="btn btn-sm btn-info"><i
                                class="material-icons">visibility</i> </a>

                        <a href="{{ route('subcategory.edit', $cat->id) }}" class="btn btn-sm btn-warning"><i
                                class="material-icons">edit</i></a>

                        <form action="{{ route('subcategory.destroy', $cat->id) }}" method="POST" class="d-inline">
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
