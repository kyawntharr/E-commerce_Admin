<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        $cats = Category::all();
        $subcats = SubCategory::all();
        $tags = Tag::all();
        return view('product.crate', compact('cats', 'subcats', 'tags'));
    }

    public function store(ProductCreateRequest $request)
    {
        $files = $request->file('images');
        $images = '';
        foreach ($files as $file) {
            $imageName = uniqid() . '_' . $file->getClientOriginalName();
            $images .= $imageName . ',';
            $file->move(public_path() . '/uploads/product/', $imageName);
        }
        $images = rtrim($images, ',');
        // echo $images;

        $product = new Product();
        $product->category_id = $request->input('category_id');
        $product->subcat_id = $request->input('subcat_id');
        $product->tag_id = $request->input('tag_id');
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->colors = $request->input('colors');
        $product->sizes = $request->input('sizes');
        $product->description = $request->input('description');
        $product->images = $images;

        if ($product->save()) {
            return redirect()->route('products.index');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Fail to create product.');
        }
    }

    public function show(Product $product)
    {
        //
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $cats = Category::all();
        $subcats = SubCategory::all();
        $tags = Tag::all();

        return view('product.edit', compact('product', 'cats', 'subcats', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'subcat_id' => 'required',
            'tag_id' => 'required',
            'name' => 'required|unique:products,name,' . $id,
            'price' => 'required',
            'colors' => 'required',
            'sizes' => 'required',
            'description' => 'required',
        ]);

        $product = Product::find($id);

        if (!$product) {
            return redirect()
                ->route('products.index')
                ->with('error', 'Product not found');
        }

        if ($request->has('images')) {
            $files = $request->file('images');
            $images = [];
            foreach ($files as $file) {
                $imageName = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/product/', $imageName);
                $images[] = $imageName;
            }
            $product->images = implode(',', $images);
        }

        $product->category_id = $request->input('category_id');
        $product->subcat_id = $request->input('subcat_id');
        $product->tag_id = $request->input('tag_id');
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->colors = $request->input('colors');
        $product->sizes = $request->input('sizes');
        $product->description = $request->input('description');

        if ($product->save()) {
            return redirect()
                ->route('products.index')
                ->with('success', 'Product updated successfully');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Failed to update product');
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product->delete()) {
            return redirect()->route('products.index');
        } else {
            return redirect()
                ->back()
                ->with('error', 'You can\'t delete');
        }
    }
}
