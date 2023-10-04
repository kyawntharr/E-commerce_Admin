<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $cats = Category::get();
        return view('category.index', compact('cats'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(CategoryCreateRequest $request)
    {
        $file = $request->file('image');
        $imageName = $file->getClientOriginalName();
        $file->move(public_path() . '/uploads', $imageName);
        $cat = new Category();
        $cat->name = $request->input('name');
        $cat->image = $imageName;

        if ($cat->save()) {
            return redirect()->route('cats.index');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Category insert error');
        }
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category, $id)
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category, $id)
    {
        $validate = $request->validate([
            'name' => 'required',
        ]);
        if ($validate) {
            $category = Category::find($id);
            $category->name = $request->input('name');

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = $file->getClientOriginalName();
                $file->move(public_path() . '/uploads', $imageName);
                $category->image = $imageName;
            }

            if ($category->update()) {
                return redirect()->route('cats.index');
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Category Update error!');
            }
        }
    }

    public function destroy(Category $category, $id)
    {
        $cat = Category::find($id);
        if ($cat->delete()) {
            return redirect()->back();
        }
    }
}
