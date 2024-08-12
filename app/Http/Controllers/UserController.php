<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    public function signup(Request $request)
    {
        try {
            // get input data from client
            $data = $request->all();

            // Validate input
            $validator = Validator::make($data, [
                User::NAME => 'required|string|max:255',
                User::EMAIL => 'required|string|email|max:255|unique:' . User::TABLE,
                User::PASSWORD => 'required|string|min:8|confirmed',
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return $this->sendError('something went wrong', 422, $validator->errors());
            }

            // Create new user
            $user = User::create([
                User::NAME => $data['name'],
                User::EMAIL => $data['email'],
                User::PASSWORD => Hash::make($data['password']),
            ]);

            // Return the newly created user
            return $this->sendResponse($user, "User registered successfully", 201);
        } catch (\Throwable $error) {
            return $this->sendError('something went wrong', 500, $error);
        }
    }

    // Handle user login
    public function login(Request $request)
    {
        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                User::EMAIL => 'required|string|email',
                User::PASSWORD => 'required|string'
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return $this->sendError('something went wrong', 422, $validator->errors());
            }

            // Attempt to authenticate user with credentials
            $credentials = $request->only('email', 'password');

            // Check user exists and password is correct
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('Personal Access Token')->plainTextToken;

                return response()->json([
                    'user' => $user,
                    'token' => $token
                ], 200);
            }

            // send response
            return $this->sendError('Unauthorized', 401);
        } catch (\Throwable $error) {
            return $this->sendError('something went wrong', 500, $error);
        }
    }

    public function logout()
    {
        try {
            // Delete all tokens of the authenticated user
            Auth::user()->tokens()->delete();

            // send response
            return $this->sendResponse(null, "User logged out successfully");
        } catch (\Throwable $error) {
            return $this->sendError('something went wrong', 500, $error);
        }
    }
}
