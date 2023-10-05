@extends('layouts.app-master')
@section('title', 'Tag Create')
@section('content')
    <h2>Edit Tag</h2>
    <a href="{{ route('tags.index') }}" class="btn btn-sm btn-secondary"><i class="material-icons">arrow_back</i></a>
    <form action="{{ route('tags.update',$tag->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="col-md-6 offset-3">
            <x-input type="text" name="name" value="{{ $tag->name }}"></x-input>
            <button class="btn btn-sm btn-primary float-end">Update</button>
        </div>
    </form>
@endsection
