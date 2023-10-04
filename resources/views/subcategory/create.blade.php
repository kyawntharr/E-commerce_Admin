@extends('layouts.app-master')

@section('title', 'Sub Category Create')
@section('content')
    <h1>Create Sub Categories</h1>

    <a href="{{ route('categories.subcategory.index',$cat->id) }}" class="btn btn-sm btn-secondary"><i class="material-icons">arrow_back</i></a>

    <div class="col-md-6 offset-3">
        <form action="{{ route('categories.subcategory.store',$cat->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-input name="name" type="text"></x-input>
            <x-input name="image" type="file"></x-input>
            <button type="submit" class="btn btn-sm btn-primary float-end">Create</button>
        </form>
    </div>
@endsection
