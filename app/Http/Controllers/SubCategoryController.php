<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index($id)
    {
        $cat = Category::with('subcats')->find($id);
        // dd($cat->toArray());
        return view('subcategory.index', compact('cat'));
    }

    public function create($id)
    {
        $cat = Category::find($id);

        return view('subcategory.create', compact('cat'));
    }

    public function store(CategoryCreateRequest $request, $id)
    {
        $file = $request->file('image');
        $imageName = uniqid() . '_' . $file->getClientOriginalName();
        $file->move(public_path() . '/uploads/subcategory', $imageName);

        $cat = new SubCategory();
        $cat->name = $request->input('name');
        $cat->image = $imageName;
        $cat->category_id = $id;

        if ($cat->save()) {
            return redirect()->route('categories.subcategory.index', $id);
        } else {
            return redirect()
                ->back()
                ->with('error', 'Sub Category Create Fail!');
        }
        // dd($cat->toArray());
    }
    public function show(SubCategory $subCategory, $id)
    {
        $subcat = SubCategory::with('cat')->find($id);

        // dd($subcat->all()->toArray());
        return view('subcategory.show', compact('subcat'));
    }

    public function edit(SubCategory $subCategory, $id)
    {
        $subcat = SubCategory::find($id);
        return view('subcategory.edit', compact('subcat'));
    }
    public function update(Request $request, SubCategory $category_id, $id)
    {
        // dd($request->$category_id);

        $validator = $request->validate([
            'name' => 'required',
        ]);
        if ($validator) {
            $subcat = SubCategory::find($id);
            $subcat->name = $request->input('name');
            // dd($subcat->category_id);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/subcategory', $imageName);
                $subcat->image = $imageName;
            }

            if ($subcat->update()) {
                return redirect()->route('categories.subcategory.index', $subcat->category_id);
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Sub Category Update Fail!');
            }
        }
        // dd($request->toArray());
    }

    public function destroy(SubCategory $subCategory, $id)
    {
        $subCategory = SubCategory::find($id);
        if ($subCategory->delete()) {
            return redirect()->back();
        }
    }
}
