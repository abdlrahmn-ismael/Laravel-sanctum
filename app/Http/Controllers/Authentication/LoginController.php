<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to find the user by email
        $user = User::where('email', $request->email)->first();

        // If user not found or password doesn't match, return error
        if (!$user || !Hash::check($request->password, $user->password)) {
            $errors = [
                'email' => ['The provided credentials are incorrect.'],
            ];
            return $this->validationResponse($errors);
        }

        // Generate token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return success response with user and token
        return $this->successResponse("login successfully. welcome!", [
            "user"  =>  new UserResource($user),
            "token" => $token,
        ]);
    }
}
