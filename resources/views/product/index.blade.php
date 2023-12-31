@extends('layouts.app-master')
@section('title', 'All Products')
@section('content')
    <h2>All Product</h2>
    <a href="{{ route('products.create') }}" class="btn btn-sm btn-success">Create Product<i class="material-icons">add</i></a>

    <table class="table my-4">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Images</th>
                <th>Colors</th>
                <th>Sizes</th>
                <th>Price</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $product->name }}</td>
                    <td>
                        @php
                            $images = explode(',', $product->images);
                        @endphp
                        @foreach ($images as $image)
                            <img src="{{ url('/uploads/product/' . $image) }}" width="50px" height="50px" alt=""
                                onclick="showLightBox('{{ url('/uploads/product/' . $image) }}')">
                        @endforeach
                    </td>
                    <td>{{ $product->colors }}</td>
                    <td>{{ $product->sizes }}</td>
                    <td>{{ $product->price }} KS</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-info"><i class="material-icons">info</i></a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning"><i
                                class="material-icons">edit</i></a>

                        <form action="{{ route('products.destroy', $product->id) }}" class="d-inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="material-icons">delete</i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="modal" tabindex="-1" id="lightBox">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="" alt="" class="img-fluid" id="img">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div> --}}
@endsection
@push('script')
    <script>
        let showLightBox = (image) => {
            let img = document.querySelector('#img');
            img.src = image;
            let myModal = new bootstrap.Modal(document.getElementById('lightBox'), {
                keyboard: false
            })
            myModal.show();
        }
    </script>
@endpush
