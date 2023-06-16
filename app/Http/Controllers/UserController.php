<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;

class UserController extends Controller
{
    //INDEX FUNCTION
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('IsAdmin');
    }

    public function index()
    {
        
        $users = User::all();
        //$admins = User::where('admin', 1)->get();
        return view('users.index', compact('users'));
    }

    //CREATE FUNCTION
    public function create()
    {
        $users = User::all();

        $user_types = UserType::all();

        return view('auth.register', compact('users', 'user_types'));
    }

    //STORE FUNCTION
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['string', 'max:45'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required'],
            'user_type' => ['required', 'integer'],
        ]);

        if($request->password == $request->password_confirmation)
        {
            if ($request->hasFile('image')) 
            {
                $file = $request->file('image');
                $file_name = $file->getClientOriginalName();
                $destination = public_path().'/IMAGES/profile';
                $file->move($destination, $file_name);
                
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'image' => '/IMAGES/profile/'.$file_name,
                    'password' => Hash::make($request->password),
                    'password_confirmation' => Hash::make($request->password_confirmation),
                    'user_type_id' => $request->user_type
                ]);

                if($user){
                    session()->flash('message', 'User created successfully');
                    return redirect(route('users.index'));
                }
            }else{
                session()->flash('message_err', 'You must select an image for this user');
                return redirect()->route('users.create');
            }
        }else{
            session()->flash('message_err', 'The password must match');
            return redirect()->route('users.create');
        }
    }

    //SHOW FUNCTION
    public function show($id)
    {
        //
    }

    //EDIT FUNCTION
    public function edit(User $user)
    {
        $users = User::all();

        $user_types = UserType::all();

        return view('users.edit', compact('users', 'user', 'user_types'));
    }

    //UPDATE FUNCTION
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['string', 'min:3', 'max:20'],
            'email' => ['string', 'min:8', 'max:45'],
            'user_type' => ['required', 'integer'],
            'password' => ['min:8', 'max:25'],
            'password_confirmation' => ['min:8', 'max:25']

        ]);

        if($request->password == $request->password_confirmation)
        {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'password_confirmation' => Hash::make($request->password_confirmation),
                'user_type_id' => $request->user_type,
            ]);

            if($user){
                session()->flash('message', 'User edited successfully');
                return redirect()->route('users.index');
            }
        }else{
            session()->flash('message_err', 'The password must match');
            return redirect()->route('users.index');
        }
    }

    //EDIT FUNCCTION
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('message', "User deleted successfully");
        return redirect()->route('users.index');
    }
}
