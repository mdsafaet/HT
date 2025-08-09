<?php

namespace App\Http\Controllers;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Trait\TraitsApiResponseTrait;
use Illuminate\Http\Request;

use App\Http\Requests\UserRegisterRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AuthController extends Controller
{

use  TraitsApiResponseTrait,AuthorizesRequests;

    
 public function register(UserRegisterRequest $request) {

    $data = $request->validated();

  

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'role_id' => $data['role_id'],
        

     
    ]);

    $token = auth('api')->login($user);

    return $this->success($token);
    }
    

    public function login( Request $request )
    {
        // $credentials = request(['email', 'password']);

        // if (! $token = auth()->attempt($credentials)) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }

        // return $this->respondWithToken($token);

        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return $this->success('Login successful', [
            'token' => $token,
            'user' => auth()->user()->load('role'),
        ]);
    }

    
    public function me()
    {
        return response()->json(auth()->user());
    }

   
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

   
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}