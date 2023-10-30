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
        $users = User::all();
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

        // dd($data);
        
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
    
}
