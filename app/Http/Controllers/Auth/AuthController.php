<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:3',
        ]);
        if ($v->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json(['status' => 'success'], 201);
    }

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
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()

        ]);
    }


    // public function register(Request $request)
    // {
    //     $v = Validator::make($request->all(), [
    //         'name' => 'required|min:3',
    //         'email' => 'required|email|unique:users',
    //         'password'  => 'required|min:3',
    //     ]);
    //     if ($v->fails()) {
    //         return response()->json([
    //             'status' => 'error',
    //             'errors' => $v->errors()
    //         ], 422);
    //     }
    //     $user = new User();
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->password = bcrypt($request->password);
    //     $user->save();
    //     return response()->json(['status' => 'success'], 200);
    // }




    // /**
    //  * Login user and return a token
    //  */
    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');
    //     if ($token = $this->guard()->attempt($credentials)) {
    //         return response()->json(['status' => 'success', 'token' => $token], 200)->header('Authorization', $token);
    //     }
    //     return response()->json(['error' => 'login_error'], 401);
    // }

    // /**
    //  * Logout User
    //  */
    // public function logout()
    // {
    //     $this->guard()->logout();
    //     return response()->json([
    //         'status' => 'success',
    //         'msg' => 'Logged out Successfully.'
    //     ], 200);
    // }

    // /**
    //  * Get authenticated user
    //  */
    // public function user(Request $request)
    // {
    //     $user = User::find(Auth::user()->id);
    //     return response()->json([
    //         'status' => 'success',
    //         'data' => $user
    //     ]);
    // }

    // /**
    //  * Refresh JWT token
    //  */
    // public function refresh()
    // {
    //     if ($token = $this->guard()->refresh()) {
    //         return response()
    //             ->json(['status' => 'successs'], 200)
    //             ->header('Authorization', $token);
    //     }
    //     return response()->json(['error' => 'refresh_token_error'], 401);
    // }

    // /**
    //  * Return auth guard
    //  */
    // private function guard()
    // {
    //     return Auth::guard();
    // }
}
