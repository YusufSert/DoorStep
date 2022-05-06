<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\SubSubCategory;


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

    public function SubCategoryEdit($id) {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategory= SubCategory::findOrFail($id);
        return view('backend.category.subcategory_edit',compact('subcategory', 'categories'));
    }

    public function SubCategoryUpdate(Request $request)
    {
        $subcat_id = $request->id;
        
        SubCategory::findOrFail($subcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_tr' => $request->subcategory_name_tr,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_tr' => strtolower(str_replace(' ', '-', $request->subcategory_name_tr)),
        ]);

        return redirect()->route('all.subcategory');
    }

    public function SubCategoryDelete($id) {
        SubCategory::findOrFail($id)->delete();
        
        $notification = array(
            'message' => 'Category Deleted Succesfully',
            'alert-type' => 'succes'

        );

        return redirect()->back()->with($notification);

    }







    ///// sub->subcategory ///////////////


    public function SubSubCategoryView() {

        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subsubcategories = SubSubCategory::latest()->get();
        return view('backend.category.sub_subcategory_view', compact('subsubcategories', 'categories'));
    }

   

    public function GetSubCategory($category_id){

        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();
        return json_encode($subcat);
    }

    public function SubSubCategoryStore(Request $request) {

        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_tr' => 'required'
        ],[
            'category_id.required' => 'Select Category Please',
            'subcategory_id.required' => 'Select SubCategory Please',
            'subsubcategory_name_en.required' => 'Enter Name Please',
            'subsubcategory_name_tr.required' => 'Enter Name Please'
        ]);
        
        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_tr' => $request->subsubcategory_name_tr,
            'subsubcategory_slug_en' => strtolower(str_replace(' ' , '-', $request->subsubcategory_name_en)),
            'subsubcategory_slug_tr' => strtolower(str_replace(' ' , '-', $request->subsubcategory_name_tr)),
        ]);

        $notification = array(
            'message' => 'Sub->SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }

    public function SubSubCategoryEdit($id) {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name_en', 'ASC')->get();
        $subsubcategories = SubSubCategory::findOrFail($id);

        return view('backend.category.sub_subcategory_edit', compact('categories', 'subcategories', 'subsubcategories'));
    }
    

}
