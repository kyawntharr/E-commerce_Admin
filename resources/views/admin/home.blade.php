@extends('layouts.app-master')

@section('title', 'Admin Home Page')
@section('content')

    @if (Session::has('info'))

        @php
            $email = Auth::user()->email;
            $password = Auth::user()->password;
        @endphp
        @if (Session::get('info') === 'on')
            <script>
                let email = "{{ $email }}"
                localStorage.setItem('rememberMe', true)
                localStorage.setItem('email', email)
            </script>
        @else
            <script>
                localStorage.setItem('rememberMe', false)
                localStorage.removeItem('email')
            </script>
        @endif
    @endif

    <h1>Admin home page</h1>
@endsection
