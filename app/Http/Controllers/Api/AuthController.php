<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function auth( AuthRequest $requerst){
        $credenctials = $requerst->only([
            'email',
            'password',
            'device_name'
        ]);
        $user = User::where('email', $credenctials['email'])->firstOrFail();
        $password = Hash::check($credenctials['password'], $user->password);
        if(!$user || !$password) throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);

        //Logoutn de outros dispositivos
        $user->tokens()->delete();

        $token = $user->createToken($credenctials['device_name'])->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logout realizado com sucesso'
        ]);
    }

    //me 
    public function me(Request $request){
        return response()->json([
            'user' => $request->user()
        ]);
    }

    //register
    public function register(AuthRequest $request){
        $credenctials = $request->only([
            'name',
            'email',
            'password'
        ]);
        $credenctials['password'] = Hash::make($credenctials['password']);
        $user = User::create($credenctials);
        $token = $user->createToken($request->device_name)->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }
}
