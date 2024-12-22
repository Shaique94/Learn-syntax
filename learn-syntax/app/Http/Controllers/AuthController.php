<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // Register method
    public function register(Request $request)
    {
        // Check if email already exists
        if (User::where('email', $request->email)->exists()) {
            return response()->json(['error' => 'Email already in use.'], 409);
        }

        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email|max:255',
            'password' => 'required|string|min:6',
        ]);

        // Create new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return response()->json(['message' => 'User successfully registered', 'user' => $user], 200);
    }

    // Login method
    public function login(Request $request)
    {
        // Validate login credentials
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Attempt to create JWT token
        $credentials = $request->only('email', 'password');


        if ($token = JWTAuth::attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Invalid credentials', 'message' => 'login successfully'], 401);
    }


    public function User(Request $request)
    {
        try {
            // Authenticate user using token
            $user = JWTAuth::parseToken()->authenticate();

            // Determine user role
            $role = $user->is_admin ? 'admin' : 'user';

            // Fetch current admin data if the role is admin
            $adminData = [];
            if ($role === 'admin') {
                $adminData = $user; // Use the authenticated admin user data
            }

            // Handle optional profile updates
            $request->validate([
                'name' => 'nullable|string|max:255',
                'password' => 'nullable|string|min:6',
            ]);

            if ($request->has('name')) {
                $user->name = $request->input('name');
            }

            if ($request->has('password')) {
                $user->password = Hash::make($request->input('password'));
            }

            // Save updated user data
            $user->save();

            return response()->json([
                'message' => 'Authenticated as ' . ucfirst($role),
                'user' => $user,
                'role' => $role,
                'adminData' => $role === 'admin' ? $adminData : null, // Include only for admins
                'expires_in' => auth()->factory()->getTTL() * 60,
            ], 200);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['error' => 'Token has expired'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => 'Token is invalid'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Token is missing'], 401);
        }
    }

    // Logout method
    public function logout()
    {
        $token = JWTAuth::getToken();
        if (!$token) {
            return response()->json(['error' => 'Token is required for logout'], 401);
        }

        // Invalidate the token
        JWTAuth::invalidate($token);
        return response()->json(['message' => 'Successfully logged out']);
    }

    // Refresh token method
    public function refresh(Request $request)
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['error' => 'Token is required for refresh'], 401);
        }

        try {
            // Refresh the token and return it
            $newToken = JWTAuth::refresh($token);

            return $this->respondWithToken($newToken);
        } catch (\Exception $e) {
            return response()->json([

                'error' => 'Token refresh failed'
            ], 401);
        }
    }

    

    // Respond with token details
    protected function respondWithToken($token)
    {
        $user = JWTAuth::user();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $user,
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }
}
