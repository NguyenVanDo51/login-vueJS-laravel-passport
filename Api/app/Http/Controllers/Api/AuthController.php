<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        /**Validate the data using validation rules
         */
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        /**Check the validation becomes fails or not
         */
        if ($validator->fails()) {
            /**Return error message
             */
            return response()->json([ 'error'=> $validator->errors() ]);
        }

        /**Store all values of the fields
         */
        $newuser = $request->all();

        /**Create an encrypted password using the hash
         */
        $newuser['password'] = Hash::make($newuser['password']);

        /**Insert a new user in the table
         */
        $user = User::query()->create($newuser);

        /**Create an access token for the user
         */
        $success['token'] = $user->createToken('AppName')->accessToken;
        /**Return success message with token value
         */
        return response()->json(['success'=>$success], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = request(['email', 'password']);

        if(Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('Client token', ['test'])->accessToken;
            return response()->json([
                'user' => $user,
                'token' => $token
            ]);
        }
        return response()->json([
            'error' => 'Email or password invalid'
        ], 422);
    }

    public function logout(Request $request)
    {
        return response()->json([
            'message' => 'successful logout',
            'user' => $request->user()
        ]);
    }
}
