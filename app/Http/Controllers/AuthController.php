<?php

namespace App\Http\Controllers;

use App\Traits\APIResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use APIResponse;

    /**
     * Get the authenticated account.
     */
    public function user()
    {
        $user = Auth::user();

        return $this->success($user);
    }

    /**
     * Login
     *
     * @unauthenticated
     */
    public function login(Request $request)
    {
        $request->validate([
            /**
             * @example admin@example.com
             */
            'email' => 'required|email',
            /**
             * @example password
             */
            'password' => 'required',
        ]);

        if (! Auth::attempt($request->only('email', 'password'))) {
            return $this->error('Invalid credentials', 401);
        }

        $user = Auth::user();
        $user->tokens()->delete();
        $token = $user->createToken($user->role)->plainTextToken;

        $data = $user->toArray();
        $data['token'] = $token;

        return $this->success($data);
    }
}
