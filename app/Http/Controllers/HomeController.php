<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Services;
use Illuminate\Http\Request;
use App\Models\ServiceBanner;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    //
    public function index(){
        return view('dashboard');
    }

    public function fetch_data(Request $request, $id){
        // dd($request);
        $data = User::find($id);

        // $request->validate([
        //     'title' => 'required|unique:posts|max:255',
        //     'author.name' => 'required',
        //     'author.description' => 'required',
        // ]);

        return response()->json($data);
    }


    // update data
    public function update_user(Request $request, $id) {
        // Find the user by ID
        $data = User::find($id);
    
        if ($data) {
            // Check if an image was uploaded in the request
            if ($request->hasFile('image')) {
                $attachment = $request->file('image');
                $attachmentName = time() . '_' . $attachment->getClientOriginalName();
                $attachment->move(public_path('upload'), $attachmentName);
                $data->image = $attachmentName;
            }
    
            $data->name = $request->input('name');
            $data->phone = $request->input('phone');
            $data->usertype = $request->input('usertype');
            
            $update_user = $data->save();
            // Use save() instead of update()
    
            if ($update_user) {
                return response()->json([
                    'success' => true,
                    'message' => 'User status updated successfully.'
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Something went wrong',
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'message' => 'User not found',
            ]);
        }
    }
    


    // delete user
    public function destroy($id){
        $delete_user = User::find($id);

        if($delete_user){
            $delete_user->delete();
            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully.'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'User not found.'
            ]);
        }
    }

    // services page
    public function services(){
        $services_data = Services::all();
        return view('admin.services.index', ['services_data' => $services_data]);
    }

    public function services_create(Request $request){
        $data = $request->all();

        $rules = [
            'services_name' => 'required|string|max:255',
            'services_description' => 'required|string|max:255',
        ];

        $messages = [
            'services_name.required' => 'services name must be required',
            'services_description.required' => 'services description must be required',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ]);
        }

        $services_create = new Services();

        $services_create->fill($data);

        if($services_create->save()){
            return response()->json([
                'success' => true,
                'message' => 'Services added successfully.'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong.'
            ]);
        }
    }


    public function services_edit(Request $request, $id){
        $data = Services::find($id);

        return response()->json($data);
    }

    public function services_update(Request $request, $id) {
        // Find the user by ID
        $data = Services::find($id);

    
        if ($data) {
            $data->services_name = $request->input('services_name');
            $data->services_description = $request->input('services_description');
    
            $update_user = $data->update();
    
            if ($update_user) {
                return response()->json([
                    'success' => true,
                    'message' => 'Services status updated successfully.'
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Something went wrong',
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'message' => 'User not found',
            ]);
        }
    }

    public function services_delete($id){
        $delete_services = Services::find($id);

        if($delete_services){
            $delete_services->delete();
            return response()->json([
                'success' => true,
                'message' => 'Services deleted successfully.'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Services not found.'
            ]);
        }
    }


    // banner image
    public function banner(){
        $services_banner = ServiceBanner::all();
        return view('admin.services.banner', ['services_banner' => $services_banner]);
    }

    // store banner
    public function banner_store(Request $request){
        $data = $request->all();

        // dd($data);
        $rules = [
            'banner_name' => 'required|string|max:255',
            'banner_image' => 'required|mimes:jpg,png,jpeg',
        ];

        $messages = [
            'banner_name.required' => 'Banner name must be required',
            'banner_image.mimes' => 'Banner image must be in jpg, png, or jpeg format',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ]);
        }
        $banner_image = null;
        if($request->hasfile('banner_image')){
            $banner_image = time() . '.' . $request->file('banner_image')->getClientOriginalExtension();
            $request->file('banner_image')->move(public_path('upload'), $banner_image);
        }

        $store_banner = new ServiceBanner();

        $store_banner->banner_name = $request->banner_name;
        $store_banner->banner_image = $banner_image;

        if($store_banner->save()){
            return response()->json([
                'success' => true,
                'message' => 'Services banner added successfully.'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong.'
            ]);
        }
    } 
    
    // edit banner
    public function banner_edit(Request $request, $id){
        // dd($id);
        $servicesBanner = ServiceBanner::find($id);

        // dd($servicesBanner);

        if(!$servicesBanner){
            return response()->json([
                'error' => true,
                'message' => 'Banner not found',
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'banner_name' => $servicesBanner->banner_name,
                'banner_image' => $servicesBanner->banner_image,
            ]
            ]);
        // return response()->json($servicesBanner);
    }

    // update banner
    public function banner_update(Request $request, $id){
        $serviceBanner = ServiceBanner::find($id);
    
        if(!$serviceBanner){
            return response()->json([
                'error' => true,
                'message' => 'Banner not found',
            ]);
        }
    
        if($request->hasFile('banner_image')){
            if($serviceBanner->banner_image){
                $oldImagepath = public_path('upload') . '/' . $serviceBanner->banner_image;
    
                if(file_exists($oldImagepath)){
                    unlink($oldImagepath);
                }
            }
    
            $newImageName = time() . '.' . $request->file('banner_image')->getClientOriginalExtension();
            $request->file('banner_image')->move(public_path('upload'), $newImageName);
    
            $serviceBanner->banner_image = $newImageName;
        }
    
        $serviceBanner->banner_name = $request->input('banner_name');
    
        $update_banner = $serviceBanner->update(['banner_name' => $serviceBanner->banner_name, 'banner_image' => $serviceBanner->banner_image]);
    
        if($update_banner){
            return response()->json([
                'success' => true,
                'message' => 'Service updated successfully',
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong',
            ]);
        }
    }

    // delete banner
    public function banner_delete($id){
        $delete_banner = ServiceBanner::find($id);

        if($delete_banner){
            $delete_banner->delete();
            return response()->json([
                'success' => true,
                'message' => 'Services banner deleted successfully.'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Services banner not found.'
            ]);
        }
    }
}
