<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{

    public function store(Request $request)
    {
        $staff = new User;
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->password = $request->mobile_no;
        $staff->roles = $request->user_id;
        $staff->photo = $request->base64_text;
        $staff->base64 = $request->base64_text;
        $staff->user_id = $request->user_id;
        $staff->save();
        return response()->json(['message' => 'Staff register succesfully']);



    }
}