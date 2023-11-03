<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Services;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        return view('dashboard');
    }

    public function fetch_data(Request $request, $id){
        // dd($request);
        $data = User::find($id);

        return response()->json($data);
    }


    // update data
    public function update_user(Request $request, $id) {
        // Find the user by ID
        $data = User::find($id);

    
        if ($data) {
            $data->name = $request->input('name');
            $data->phone = $request->input('phone');
            $data->usertype = $request->input('usertype');
    
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
    
}
