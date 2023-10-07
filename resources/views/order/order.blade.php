@extends('layouts.app-master')
@section('title', 'All Orders')
@section('content')
    <h2 class="text-center text-primary">All Orders</h2>
    <div class="col-md-8 offset-md-2">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Count</th>
                    <th>Total</th>
                    <th>Items</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $key => $order)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ Auth::user()->name }}</td>
                        <td>{{ $order->count }}</td>
                        <td>{{ $order->total }}</td>
                        <td>
                            <a href="{{ route('orderitembyId', $order->id) }}" class="btn btn-sm btn-info"><i
                                    class="material-icons">visibility</i></a>
                        </td>
                        <td>
                            <form action="{{ route('order.status', $order->id) }}" method="POST">
                                @csrf
                                {{-- @method('PATCH') --}}
                                <button
                                    class="btn btn-sm @if ($order->status) btn-success
                                @else
                                    btn-danger @endif">
                                    @if ($order->status)
                                    Accept
                                    <i class="material-icons">check_circle</i>
                                    @else
                                    Denine
                                    <i class="material-icons">unpublished</i>
                                    @endif
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
