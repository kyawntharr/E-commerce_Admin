@extends('layouts.app-master')

@section('title', 'Sub Category view')
@section('content')
    <h4>Sub Category Details</h4>

    <a href="{{ route('categories.subcategory.index',$subcat->category_id) }}" class="btn btn-sm btn-secondary"><i class="material-icons">arrow_back</i></a>

    <div class="col-md-6 offset-3">
        <div class="row">
            <p><img src="{{ url('/uploads/subcategory/', $subcat->image) }}" style="width: 100px;height:100px" alt=""></p>
            <div class="col-md-4 float-end">
                <strong>
                    <p>Category</p>
                    <p>Name</p>
                    <p>Image</p>
                    <p>Create Date</p>
                    <p>Update Date</p>
                </strong>

            </div>
            <div class="col-md-8">

                <p>: {{ $subcat->cat->name }}</p>
                <p>: <a href="{{ url('/uploads/subcategory/', $subcat->image) }}">{{ $subcat->image }}</a></p>
                <p>: {{ $subcat->name }}</p>
                <p>: {{ $subcat->created_at }}</p>
                <p>: {{ $subcat->updated_at }}</p>
            </div>
        </div>
    </div>
@endsection
