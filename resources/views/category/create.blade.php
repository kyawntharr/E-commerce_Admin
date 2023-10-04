@extends('layouts.app-master')
@section('title', 'Categories')
@section('content')
    <h1>Create Categories</h1>

    <a href="{{route('cats.index') }}" class="btn btn-sm btn-secondary"><i class="material-icons">arrow_back</i></a>

    <div class="col-md-6 offset-3">
        <form action="{{ route('cats.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-input name="name" type="text"></x-input>
            <x-input name="image" type="file"></x-input>
            <button type="submit" class="btn btn-sm btn-primary float-end">Create</button>
        </form>
    </div>
@endsection
