<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use App\Models\Role;
use Webpatser\Uuid\Uuid;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login', 'check']]);
    }

    public function register(UserRegisterRequest $request)
    {
        $request->validated();

        User::create([
            'id' => Uuid::generate(),
            'first_name' => $request->first_name,
            'prefix' => $request->prefix,
            'last_name' => $request->last_name,
            'country' => $request->country,
            'province' => $request->province,
            'city' => $request->city,
            'address' => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_number' => $request->phone_number,
            'date_of_birth' => $request->date_of_birth,
        ]);

        return response()->json([
            'message' => 'Successfully created user.'
        ]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(UserLoginRequest $request)
    {
        $request->validated();

        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function check()
    {
        $auth;
        $role;

        if (auth()->user() === null) {
            $auth = false;
            $role = null;

            return response()->json([
                'auth' => $auth,
            ], 401);
        }

        else {
            $auth = true;
            $role = auth()->user()->with('role')->first();

            return response()->json([
                'auth' => $auth,
                'role' => $role
            ], 200);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
