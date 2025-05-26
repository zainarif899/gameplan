<?php

namespace App\Http\Controllers;

use App\Repositories\interface\Userinterface;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Game Plan API",
 *     version="1.0.0"
 * )
 */
class UserrepController extends Controller
{
    protected $userRepo;

    public function __construct(Userinterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Get all users",
     *     tags={"Users"},
     *     @OA\Response(
     *         response=200,
     *         description="List of users"
     *     )
     * )
     */
    public function index()
    {
        $users = $this->userRepo->all();
        return response()->json($users);
    }

    public function create()
    {
        return view('register');
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     summary="Create new user",
     *     tags={"Users"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","password"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="password", type="string", format="password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User created"
     *     )
     * )
     */
    public function store(Request $request)
    {
        try {
            $data = $request->only(['name', 'email', 'password']);
            $data['password'] = bcrypt($data['password']);
            $user = $this->userRepo->create($data);
            $success['token'] = $user->createToken('myapp')->plainTextToken;

            return response()->json($user, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to create user'], 400);
        }
    }

    public function login()
    {
        return view('login');
    }

    /**
     * @OA\Post(
     *     path="/api/logins",
     *     summary="Login user",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="password", type="string", format="password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successful"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials"
     *     )
     * )
     */
    public function logins(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return response()->json("Login successful");
            } else {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    public function show($id)
    {
        $user = $this->userRepo->find($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->only(['name', 'email', 'password']);
            $data['password'] = bcrypt($data['password']);
            $user = $this->userRepo->update($id, $data);
            $success['token'] = $user->createToken('myapp')->plainTextToken;
            return response()->json($user);
        } catch (Exception $e) {
            return response()->json(['error' => 'Update failed'], 400);
        }
    }

    public function destroy($id)
    {
        $this->userRepo->delete($id);
        return response()->json(['message' => 'User deleted']);
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return response()->json(['message' => 'User logged out']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Logout failed'], 500);
        }
    }

    public function homepage()
    {
        return view('home');
    }
}
