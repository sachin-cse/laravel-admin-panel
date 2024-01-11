<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    public function index(){
        $testimonial = Testimonial::all();
        // dd($testimonial);
        return view('admin.testimonial', ['testimonial' => $testimonial]);
    }

    public function testimonial_store(Request $request){
        $data = $request->all();

        $rules = [
            'name' => 'required|string|max:255',
            'file' => 'required|mimes:jpg,png,jpeg',
            'rating' => 'required',
            'description' => 'required'
        ];

        $messages = [
            'name.required' => 'name must be required',
            'file.required' => 'image must be required',
            'file.mimes' => 'Banner image must be in jpg, png, or jpeg format',
            'rating.required' => 'rating must be required',
            'description.required' => 'description must be required'
        ]; 

        $validator = Validator::make($data, $rules, $messages);

        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => 'Validation failed',
                'errors' => $validator->errors()->first()
            ]);
        }
        $testimonial_image = null;
        if($request->hasfile('file')){
            $testimonial_image = time() . '.' . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->move(public_path('upload'), $testimonial_image);
        }

        $store_testimonial = new Testimonial();

        $store_testimonial->name = $request->name;
        $store_testimonial->image = $testimonial_image;
        $store_testimonial->rating = $request->rating;
        $store_testimonial->description = strip_tags($request->description);

        if($store_testimonial->save()){
            return response()->json([
                'success' => true,
                'message' => 'Testimonial added successfully.'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong.'
            ]);
        }
    }

    // edit part
    public function testimonial_edit(Request $request, $id){
        $testimonial = Testimonial::find($id);
        // dd($testimonial);
        return response()->json($testimonial);
    }
}
