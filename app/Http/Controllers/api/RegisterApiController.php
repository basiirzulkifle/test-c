<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterApiController extends Controller
{
    public function registerstaff(Request $request)
    {
        //get photo
        // $request->validate([
        //     'user_id'=>'required',
        //     'base64images' => 'image'
        // ]);
        
        //get user_id and base64
        $request->validate([
            'user_id'=>'required',
            'base64images' => 'required'
        ]);
        
         
        
       $user = User::create([
            'name' => $request->input('user_id'),
            'email' => $request->input('description'),
            'password' => Hash::make($request->input('password')),
            'roles' => ['2'],
            'approved' => 0,
        ]);

        $user->addMedia(storage_path('tmp/uploads/' . basename($data['photo'])))->toMediaCollection('photo');

        return response()->json(['user' => $user], 201);
    }
}
