<?php

namespace App\Http\Controllers\Admin;

use Log;
use App\Models\User;
use App\Models\Aboutus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function register_roles(){
        $users = User::paginate(1);
        // dd($users);
        return view('admin.register-roles')->with('users', $users);
    }

    // about us view 
    public function about_usview(){
        $data = Aboutus::all();
        return view('admin.aboutus', ['data' => $data]);
    }

    public function store_aboutus(Request $request) {
        $data = $request->all();
        
        $about_us = new Aboutus();
        
        // Make sure the fields are fillable in your model
        $about_us->fill($data);
        
        if ($about_us->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Data saved successfully.'
            ]);
        } else {

            // Log::error('Error while saving data: ' . print_r($about_us->getErrors(), true));
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong.'
            ]);
        }
    }

    // about us
    public function fetch_aboutus(Request $request, $id){
        $data = Aboutus::find($id);

        return response()->json($data);
    }

    // update aboutus
    public function update_aboutus(Request $request, $id) {
        // Find the user by ID
        $data = Aboutus::find($id);

    
        if ($data) {
            $data->title = $request->input('title');
            $data->subtitle = $request->input('subtitle');
            $data->description = $request->input('description');
    
            $update_user = $data->update();
           
    
            if ($update_user) {
                return response()->json([
                    'success' => true,
                    'message' => 'abouts us status updated successfully.'
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
                'message' => 'data not found',
            ]);
        }
    }

    // delete update user
    public function delete_aboutus($id){
        $delete_user = Aboutus::find($id);

        if($delete_user){
            $delete_user->delete();
            return response()->json([
                'success' => true,
                'message' => 'About us deleted successfully.'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Data not found.'
            ]);
        }
    }
    
}
