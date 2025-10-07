<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Display of the add categories form page
    public function category_page()
    {
        return view('admin.layouts.category');
    }


    /* 
        method to add category(creates new category model) by accepting data from form
        The new instance is saved in the database and a notification is received 
    */
    public function add_category(Request $request)
    {
        $data= new Category;
        $data->name = $request->name;
        $data->description = $request->description;
        $data->save();
        notify()->success('Category added successfully');
        return redirect()->back();
    }


    // Display page ofthe list of categories in a table that can also be searched by name 
    public function display_category(Request $request)
    {
        $query = Category::query();

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        $category = $query->orderBy('name')->get();

        return view('admin.layouts.disp_category', compact('category'));
    }


    // method to delete category by ID and redirect with a notification 
    public function category_delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        notify()->success('Category deleted successfully');
        return redirect()->back();
    }


    // Displays the edit form on click of the edit button
    public function edit_category($id)
    {
        $data = Category::find($id);
        return view('admin.layouts.edit_category',compact('data'));
    }


    /* 
        Method to edit and update a particular category from its ID
        One can update either its name or description
        Data is then passed from the form and saved in the DB 
    */
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
