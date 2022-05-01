<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Intervention\Image\Facades\Image;



class BrandController extends Controller
{
    public function BrandView() {
        
        $brands = Brand::latest()->get(); // Get lates data
        return view('backend.brand.brand_view',compact('brands')); // view/backend/brand/brand_view
    }

    public function BrandStore(Request $request) {
        
        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_tr' => 'required',
            'brand_image' => 'required'
        ],[
            'brand_name_en.required' => 'Input Brand English Name',
            'brand_name_tr.required' => 'Input Brand Turkish Name',
        ]);


        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
        $save_url = 'upload/brand/'.$name_gen;

        Brand::insert([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_tr' => $request->brand_name_tr,
            'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)), // put "-", space olan yerlere
            'brand_slug_tr' => strtolower(str_replace(' ', '-', $request->brand_name_tr)),
            'brand_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Brand Inserted Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
