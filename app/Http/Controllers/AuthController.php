<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * Class Autentication
 * 
 * pretected $fillable = ['name', 'email', 'password', 'confirm_password'];
 * by riyanris, 03 jan 2024
 */
class AuthController extends Controller
{

    public function index()
    {
        return response()->json([
            'message' => trans('auth.welcome'),
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:65',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4|max:16',
            'confirm_password' => 'required|same:password'
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json([
            'message' => trans('auth.success_register'),
            'data' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'message' => trans('auth.success_login'),
                'token' => $token,
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'message' => trans('auth.failed_login')
            ], 400);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => trans('auth.logout')
        ]);
    }

    public function users()
    {
        $users = User::all();
        return response()->json([
            'message' => trans('user.success_fetch'),
            'data' => $users
        ]);
    }
}
