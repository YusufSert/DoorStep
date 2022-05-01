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


    public function BrandEdit ($id) {
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }

    public function BrandUpdate(Request $request) {
        $brand_id = $request->id;
        $old_img = $request->old_image; // so you can get old picture url cünkü yenisi boş olarak gelecek hidden input ile al

        if($request->file('brand_image'))// if new image choosen
        {
            unlink($old_img); // "upload/brand/1731613795088244.png" path dakini sil
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
            $save_url = 'upload/brand/'.$name_gen;

            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_tr' => $request->brand_name_tr,
                'brand_slug_en' => strtolower(str_replace(' ', '-',$request->brand_name_en)),
                'brand_slug_tr' => strtolower(str_replace(' ', '-', $request->brand_name_tr)),
                //'brand_image' => $save_url,
            ]);

            return redirect()->route('all.brand');
        } else
        {
            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_tr' => $request->brand_name_tr,
                'brand_slug_en' => strtolower(str_replace(' ', '-',$request->brand_name_en)),
                'brand_slug_tr' => strtolower(str_replace(' ', '-', $request->brand_name_tr)),
                'brand_image' => $old_img,
            ]);

            return redirect()->route('all.brand');

        }
    }

    public function Delete($id)
    {
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img);
        Brand::findOrFail($id)->delete();
        return redirect()->back();

    }
}
