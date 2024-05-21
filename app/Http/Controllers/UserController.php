<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    function login(){
        return response()->json(['status' => false, 'message' => "Authentication failed ", 'code' => 219]);
    }
    function index(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        // print_r($data);
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['status' => false, 'message' => "These credentials do not match our records !", 'code' => 404]);
        }

        $token = $user->createToken('thisisaiklsdhjaskjdhRETERTREDFdfsdsfds3432423432')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response()->json(['status' => true, 'message' => $response, 'code' => 200]);
        // return response($response, 201);
    }
}
