@extends('layouts.app-master')
@section('title', 'All Order Items')
@section('content')
    <h2 class="text-center text-primary">All Order Items</h2>
    <div class="col-md-10 offset-md-1">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Count</th>
                    <th>Total</th>
                </tr>
            </thead>
            {{-- $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id');
            $table->foreignId('category_id');
            $table->foreignId('subcat_id');
            $table->foreignId('tag_id');

            $table->string('name');
            $table->string('images');
            $table->integer('price');
            $table->string('color');
            $table->string('size');
            $table->integer('count');
            $table->integer('total'); --}}
            <tbody>
                @foreach ($orderitems as $key => $items)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $items->name }}</td>
                        <td>
                            @php
                                $images = explode(',', $items->images);
                            @endphp
                            @foreach ($images as $image)
                                <img src="{{ url('/uploads/product/' . $image) }}" width="50px" height="50px" alt="">
                            @endforeach
                        </td>
                        <td>{{ $items->color }}</td>
                        <td>{{ $items->size }}</td>
                        <td>{{ $items->price }}</td>
                        <td>{{ $items->count }}</td>
                        <td>{{ $items->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
