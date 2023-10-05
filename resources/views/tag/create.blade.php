@extends('layouts.app-master')
@section('title', 'Tag Create')
@section('content')
    <h2>Create New Tag</h2>
    <a href="{{ route('tags.index') }}" class="btn btn-sm btn-secondary"><i class="material-icons">arrow_back</i></a>
    <form action="{{ route('tags.store') }}" method="POST">
        @csrf
        <div class="col-md-6 offset-3">
            <x-input type="text" name="name"></x-input>
            <button class="btn btn-sm btn-primary float-end">Create</button>
        </div>
    </form>
@endsection
