@extends('layouts.app-master')
@section('title', 'All Products')
@section('content')
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row my-2 shadow py-4 px-2">
            <h2>Product Edit</h2>
            <div class="col-md-4">
                <x-input type="text" name="name" value="{{ $product->name }}"></x-input>
            </div>
            <div class="col-md-4">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select shadow-none rounded-0 mb-3"
                    onchange="catChange(event)">
                    @foreach ($cats as $cat)
                        <option value="{{ $cat->id }}" @if ($cat->id == $product->category_id) selected @endif>
                            {{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="subcat_id" class="form-label">Sub Category</label>
                <select name="subcat_id" id="subcat_id" class="form-select shadow-none rounded-0 mb-3">
                    {{-- @foreach ($subcats as $subcat) --}}
                        {{-- <option value="{{ $subcat->id }}" @if ($subcat->id == $product->subcat_id) selected @endif>{{ $subcat->name }}</option> --}}
                    {{-- @endforeach --}}
                </select>
            </div>
            <div class="col-md-4">
                <label for="tag_id" class="form-label">Tag</label>
                <select name="tag_id" id="tag_id" class="form-select shadow-none rounded-0 mb-3">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" @if ($tag->id == $product->tag_id) selected @endif>{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <x-input type="number" name="price" value="{{ $product->price }}"></x-input>
            </div>
            <div class="col-md-4">
                <x-input type="text" name="colors" value="{{ $product->colors }}"></x-input>
            </div>
            <div class="col-md-6">
                <x-input type="text" name="sizes" cn="size ထည့္ပါ" value="{{ $product->sizes }}"></x-input>
            </div>
            <div class="col-md-6">
                <x-input type="file" name="images[]" cn="image" m="multiple"></x-input>
            </div>
            <div class="col-md-8 offset-md-2">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" placeholder="Leave a comment here" id="description">{{ $product->description }}</textarea>
            </div>
            <div class="col-md-12 pt-4">
                <button class="btn btn-sm float-end btn-outline-primary">update</button>
            </div>
        </div>
    </form>
@endsection
@push('script')
    <script>
        let cats = "{{ $cats }}";
        cats = cats.replace(/&quot;/g, "\"");
        cats = JSON.parse(cats)

        let subcats = "{{ $subcats }}";
        subcats = subcats.replace(/&quot;/g, "\"");
        subcats = JSON.parse(subcats);

        let catChange = (e) => {
            let cat_id = e.target.value;
            filterSub(cat_id);
        }
        // console.log(subcats);
        let filterSub = (id) => {
            let subs = subcats.filter((sub) => sub.category_id == id);
            let str = "";
            for (let sub of subs) {
                str += `<option value="${sub.id}">${sub.name}</option>`;
            }
            document.querySelector('#subcat_id').innerHTML = str;
        }

        let selectedId = "{{ $product->category_id }}"
        filterSub(selectedId)
        // if(selectedId == subcats)
    </script>
@endpush
