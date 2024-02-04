<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function assignedUser()
    {
        $user = Auth::user();
        return $this->successResponse("user retreived successfully", new UserResource($user) );
    }
}
