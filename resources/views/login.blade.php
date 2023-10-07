@extends('layouts.app-master')
@section('title', 'Admin Login')
@section('content')
    <h1 class="text-center text-primary mt-4" style="text-shadow: 2px 2px 4px rgba(0, 153, 51, 0.5);">E-commerce Admin</h1>
    <div class="col-md-6 offset-md-3">

        <form method="post" class="shadow py-5 px-4">
            @csrf
            <x-input name="email" type="email"></x-input>
            <x-input name="password" type="password"></x-input>
            <div class="row g-0">
                <div class="my-3 form-check">
                    <input type="checkbox" name="rememberMe" id="rememberMe"
                        class="form-check-input shadow border-secondary">
                    <label class="form-check-label" for="rememberMe">Remember Me</label>
                    <button type="submit" class="btn btn-sm btn-primary float-end shadow">Login</button>
                </div>
            </div>

        </form>
    </div>
@endsection
@push('script')
<script>
    let check = localStorage.getItem('rememberMe');
    if (check == 'true') {
            let email = localStorage.getItem('email');
            document.querySelector('#email').value = email;
            document.querySelector('#rememberMe').checked = check == 'true';
        }
    </script>
@endpush
