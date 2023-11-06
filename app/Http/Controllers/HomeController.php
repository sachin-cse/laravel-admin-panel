<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Services;
use Illuminate\Http\Request;
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


        $filename = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/upload', $filename);

        // dd($filename);

    
        if ($data) {
            $data->name = $request->input('name');
            $data->phone = $request->input('phone');
            $data->usertype = $request->input('usertype');
            $data->image = $filename;
    
            $update_user = $data->update();
    
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
    
}
