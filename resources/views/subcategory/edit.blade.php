@extends('layouts.app-master')

@section('title', 'Sub Category Edit')
@section('content')
    <h1>Edit Sub Categories</h1>

    <a href="{{ route('categories.subcategory.index',$subcat->category_id) }}" class="btn btn-sm btn-secondary"><i class="material-icons">arrow_back</i></a>

    <div class="col-md-6 offset-3">
        <form action="{{ route('subcategory.update', $subcat->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-input name="name" type="text" value="{{ $subcat->name }}"></x-input>
            <p>
                Current Image =>
                <a href="{{ url('/uploads/subcategory/', $subcat->image) }}">{{ $subcat->image }}</a>
            </p>
            <x-input name="image" type="file"></x-input>
            <button type="submit" class="btn btn-sm btn-primary float-end">Update</button>
        </form>
    </div>
@endsection
