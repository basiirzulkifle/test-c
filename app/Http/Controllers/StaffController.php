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
        $staff->mobile_no = $request->mobile_no;
        $staff->user_id = $request->user_id;
        $staff->base64_text = $request->base64_text;
        $staff->save();
        return response()->json(['message' => 'Staff register succesfully']);

    }
}