<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\SubCategory;


class SubCategoryController extends Controller
{
    //
    public function SubCategoryView() {

        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategory = SubCategory::latest()->get();
        return view('backend.category.subcategory_view', compact('subcategory','categories'));
    }

    public function SubCategoryStore(Request $request) {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
            'subcategory_name_tr' => 'required',
        ],[
            'category_id.required' => 'Please select Any option',
            'subcategory_name_en' => 'Input SubCategory English Nane',
            'subcategory_name_tr' => 'Input SubCategory Turkish Name',
        ]);

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name_en' =>  $request->subcategory_name_en,
            'subcategory_name_tr' => $request->subcategory_name_tr,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_tr' => strtolower(str_replace(' ', '-', $request->subcategory_name_tr)),
        ]);

          $notification = array(
            'message' => 'Category Deleted Succesfully',
            'alert-type' => 'succes'

        );

        return redirect()->back()->with($notification);

    }
}
