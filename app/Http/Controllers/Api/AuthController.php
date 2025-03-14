<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponse;
    public function register(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);        

        if ($validated->fails()) {
            return $this->error(
                $validated->errors(),
                "Validation Error",
                422
            );
        }

        try {
            $user = User::create([
                'first_name'     => $request->first_name,
                'last_name'     => $request->last_name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken($request->first_name);

            return $this->authSuccess(
                $user,
                $token->plainTextToken,
                'User registered successfully',
                200
            );

        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }

    public function login(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validated->fails()) {
            return $this->error(
                $validated->errors(),
                "Validation Error",
                422
            );
        }

        try {
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return $this->error([], 'Invalid credentials', 401);
            }

            $token = $user->createToken($request->email);

            return $this->authSuccess(
                $user,
                $token->plainTextToken,
                'User logged in successfully',
                200
            );

        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return $this->authSuccess(
            [], 
            null, 
            'User logged out successfully', 
            200
        );
    }
}
