<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStorePostRequest;
use App\Models\AuthModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    protected $auth;
    public function __construct()
    {
        $this->auth = new RegisterStorePostRequest;
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->auth::registerRules(),
            $this->auth::message()
        );

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                // implode function to disappear the '[]' at the first error
                // implode(',', $validator->errors()->all())
                'errors' => $validator->errors()->all(),
                'reponse' => 422

            ]);
        }
        ;

        $user = new AuthModel([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password'))
        ]);

        if ($user->save()) {
            return response()->json([
                'message' => 'Success Insert Data',
                'response' => '200',
                'data' => $user
            ]);
        } else {
            return response()->json([
                'message' => 'Failed',
                'response' => '400',
            ]);
        }
    }
}