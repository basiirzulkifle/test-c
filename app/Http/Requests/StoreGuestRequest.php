<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGuestRequest extends FormRequest
{
    public function authorize()
    {
        // return Gate::allows('user_create');

        //allow all visitors or guest
        return true;

    }

    public function rules()
    {
        // return [
        //     'name' => [
        //         'string',
        //         'required',
        //     ],
        //     'email' => [
        //         'required',
        //         'unique:users',
        //     ],
        //     'password' => [
        //         'required',
        //     ],
        //     'roles.*' => [
        //         'integer',
        //     ],
        //     'roles' => [
        //         'required',
        //         'array',
        //     ],
        //     'photo' => [
        //         'required',
        //     ],
        // ];
        return [
            'name' => [
                'required',
            ],
            'email' => [
                'required',
                'unique:users',
            ],
            'password' => [
                'required',
            ],
            'roles' => [
                'required',
            ],
            'photo' => [
                'required',
            ]

        ];
    }
}
