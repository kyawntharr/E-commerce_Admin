@extends('layouts.app-master')
@section('title', 'Categories')
@section('content')
    <h1>Edit Categories</h1>

    <a href="{{ route('cats.index') }}" class="btn btn-sm btn-secondary"><i class="material-icons">arrow_back</i></a>

    <div class="col-md-6 offset-3">
        <form action="{{ route('cats.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <x-input name="name" type="text" value="{{ $category->name }}"></x-input>
            <p>
                Current Image =>
                <a href="{{ url('/uploads/', $category->image) }}">{{ $category->image }}</a>
            </p>
            <x-input name="image" type="file"></x-input>
            <button type="submit" class="btn btn-sm btn-primary float-end">Update</button>
        </form>
    </div>
@endsection
