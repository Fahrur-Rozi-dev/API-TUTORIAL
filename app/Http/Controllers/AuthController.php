<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $user = User::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        return $user->createToken('user Login')->plainTextToken;
    }

    public function logout(Request $request)
    {
        $delete = $request->user()->currentAccessToken()->delete();
        if ($delete) {

            echo('data telah di hapus');
        }
    }
    public function me(Request $request)
    {
        return response()->json(Auth::user());
    }
}
