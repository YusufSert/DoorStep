<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function CategoryView() {
        $category = Category::latest()->get(); // Get lates data
        return view('backend.category.category_view',compact('category'));
    }

    public function CategoryStore(Request $request) {
        $request->validate([
            'category_name_en' => 'required',
            'category_name_tr' => 'required',
            'category_icon' => 'required',
        ],
    [
       'category_name_en.required' => 'Input Category English',
       'category_name_tr.required' => 'Input Category Turkish', 
    ]);

    Category::insert([
        'category_name_en' => $request->category_name_en,
        'category_name_tr' => $request->category_name_tr,
        'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
        'category_slug_tr' => strtolower(str_replace(' ','-',$request->category_name_tr)),
        'category_icon' => $request->category_icon,
    ]);

    $notification = array(
        'message' => 'Category Inserted Successfully',
        'alert-type' => 'succes'
    );

    // Toaster now working


    return redirect()->back();

    }

    public function CategoryEdit($id) {
        $category= Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }




    public function CategoryUpdate(Request $request) {
        $cat_id = $request->id;

        Category::findOrFail($cat_id)->update([
            'category_name_en' => $request->category_name_en,
            'category_name_tr' => $request->category_name_tr,
            'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
            'category_slug_tr' => strtolower(str_replace(' ','-',$request->category_name_tr)),
            'category_icon' => $request->category_icon,
        ]);

        $notification = array(
            'message' => 'Category Updated Succesfully',
            'alert-type' => 'succes'

        );

        return redirect()->route('all.category');

    }

    public function CategoryDelete($id) {
        Category::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Category Deleted Succesfully',
            'alert-type' => 'succes'

        );
        return redirect()->back()->with($notification);
        
    }
}
