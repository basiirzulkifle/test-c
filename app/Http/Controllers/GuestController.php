<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreGuestRequest;
use App\Models\User;
// use App\Http\Controllers\Traits\MediaUploadingTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;


class GuestController extends Controller
{
    // use MediaUploadingTrait;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function storeMedia(Request $request)
    {
        // Validates file size
        if (request()->has('size')) {
            $this->validate(request(), [
                'file' => 'max:' . request()->input('size') * 1024,
            ]);
        }
        // If width or height is preset - we are validating it as an image
        if (request()->has('width') || request()->has('height')) {
            $this->validate(request(), [
                'file' => sprintf(
                    'image|dimensions:max_width=%s,max_height=%s',
                    request()->input('width', 100000),
                    request()->input('height', 100000)
                ),
            ]);
        }

        $path = storage_path('tmp/uploads');

        try {
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
        } catch (\Exception $e) {
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    // public function store(StoreGuestRequest $request)
    // {
    //     $user = User::create($request->all());
    //     $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
    //     $user->roles()->sync($request->input('roles', []));

    //     if ($media = $request->input('ck-media', false)) {
    //         Media::whereIn('id', $media)->update(['model_id' => $user->id]);
    //     }

    //     return redirect()->route('/login');
    // }

    public function store(Request $request)
    {
        try {
            $user = User::create([
                'name' => $request->user_id,
                'email' => $request->nationality,
                'password' => $request->nirc,
                'photo' => $request->dob,
                'work_permit' => $request->work_permit,
                'roles' => ['2'],
            ]);
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            $user->roles()->sync($request->input('roles', []));
            $user->save();

            //return response success or error
            return response()->json([
                'status' => 201,
                'message' => 'User created successfully',
                'data' => $user
            ]);

        } catch (\Throwable $err) {
            return response()->json([
                'status' => 500,
                'message' => 'Error creating user',
                'data' => $err
            ]);
        }

    }
}
