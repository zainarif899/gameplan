<?php

namespace App\Http\Controllers;
use App\Repositories\interface\Userinterface;
use App\Repositories\Eloquent\Userrepository;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserrepController extends Controller
{
    protected $userRepo;

    public function __construct(Userinterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $users = $this->userRepo->all();
        return response()->json($users);

        // return view('index',compact('users'));
    }

    public function create()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        try{
        $data = $request->only(['name', 'email','password']);      
        $data['password'] = bcrypt($data['password']);        
        $user = $this->userRepo->create($data);
        $success['token'] = $user->createToken('myapp')->plainTextToken;

        if($user){
            return response()->json($user);
            // return redirect()->route('home')->with('success', 'User created successfully');
        }else{
             return redirect()->back()->with('error', 'User creation failed');
        }
        }catch(Exception $e){
            return response()->json(['error'=>'filed the valid Email or password']);
        }

        
    }

    public function login()
    {
        return view('login');
    }

   public function logins(Request $request)
   {
    try{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email','password');
    if(Auth::attempt($credentials)){
        return response()->json("login successfull");
        // return redirect()->route('home');
    } else {
        return back()->with('error', 'Invalid credentials');
    }
    }catch(Exception $e){
        return response()->json(['error'=>'filed the valid Email and password']);
    }
   }

    public function show($id)
    {
        $user = $this->userRepo->find($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        try{
        $data = $request->only(['name', 'email','password']);
        $data['password'] = bcrypt($data['password']);  
        $user = $this->userRepo->update($id, $data);
        $success['token'] = $user->createToken('myapp')->plainTextToken;
        return response()->json($user);
        }catch(Exception $e){
            return response()->json(['error'=>'filed the valid credentials']);
        }
    }

    public function destroy($id)
    {
        $this->userRepo->delete($id);
        return response()->json(['message' => 'User deleted']);
    }
    
    public function logout(Request $request)
    {
        try{
        Auth::logout();
        
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['message' => 'User logout successfull']);
        }catch(Exception $e){
            //  Auth::error('User creation failed: ' . $e->getMessage());
             return response()->json(['error' => 'User is Not Login'], 500);
        }
        // return redirect(route('user_index'));
    }

    public function homepage()
    {
        return view('home');
    }


}
