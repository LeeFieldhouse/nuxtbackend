<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\User;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'user','logout']])->except([
            'login', 'register', 'user','logout',
        ]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => "Can't find the details!"], 401);
        }
        // try {
        //     return (new UserResource($request->user()))->additional([
        //         'meta' => [
        //             'token' => $token
        //         ]
        //     ]);
        // } catch(\Exception $e) {
        //     return response()->json($e);
        // }

    }


    function register(Request $request ) {

        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
        try {
        $user = new User;
        $user->username = str_slug($request->username);
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        }
        catch(\Exception $e){
            return response()->json($e->errors);
        }

        return 'Success';
        // if (! $token = auth()->attempt($request->only(['email', 'password']))) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }


        // return (new UserResource($request->user()))->additional([
        //     'meta' => [
        //         'token' => $token
        //     ]
        // ]);
    }

    public function user(Request $request) {
        if(!auth()->user()){
            return '';
        }
        return new UserResource(($request->user()));
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
