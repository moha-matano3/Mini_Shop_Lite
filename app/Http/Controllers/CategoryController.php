<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function category_page()
    {
        return view('admin.layouts.category');
    }

    public function add_category(Request $request)
    {
        $data= new Category;
        $data->name = $request->name;
        $data->description = $request->description;
        $data->save();
        notify()->success('Category added successfully');
        return redirect()->back();
    }

    public function display_category(Request $request)
    {
        $query = Category::query();

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        $category = $query->orderBy('name')->get();

        return view('admin.layouts.disp_category', compact('category'));
    }

    public function category_delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        notify()->success('Category deleted successfully');
        return redirect()->back();
    }

    public function edit_category($id)
    {
        $data = Category::find($id);
        return view('admin.layouts.edit_category',compact('data'));
    }

    public function update_category(Request $request, $id)
    {
        $data= Category::find($id);
        $data->name = $request->name;
        $data->description = $request->description;
        $data->save();
        notify()->success('Category update successfully');
        return redirect('/display_category');
    }
}
