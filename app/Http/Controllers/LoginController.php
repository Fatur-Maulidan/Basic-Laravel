<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStorePostRequest;
use App\Models\AuthModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Get Data Success',
            'response' => 200,
            'data' => AuthModel::all()
        ]);
    }
    public function auth(Request $request)
    {
        $auth = new RegisterStorePostRequest();
        $user = AuthModel::where(
            'username',
            $request->input('username')
        )->first();

        $validator = Validator::make(
            $request->all(),
            $auth::loginRules(),
            $auth::message()
        );

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors()->all(),
                'response' => 422
            ]);
        }
        if ($user) {
            return $this->checkIfPasswordIsValid($user, $request);
        } else {
            return response()->json([
                'message' => 'Username tidak ditemukan',
                'response' => 422
            ]);
        }

    }

    private function checkIfPasswordIsValid($user, $request)
    {
        if (Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'message' => 'Login successful',
                'response' => 200,
                'data' => $user
            ]);
        } else {
            return response()->json([
                'message' => 'Password Salah coba lagi',
                'response' => 422
            ]);
        }
    }
}