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
                    session()->flash('message', 'Utilisateur crée avec succès');
                    return redirect(route('users.index'));
                }
            }else{
                session()->flash('message_err', 'Vous devez choisir une image pour cette utilisateur');
                return redirect()->route('users.create');
            }
        }else{
            session()->flash('message_err', 'les mots de passes doivent être égaux');
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
                session()->flash('message', 'Utilistaeur modifié avec succès');
                return redirect()->route('users.index');
            }
        }else{
            session()->flash('message_err', 'le mot de passe ne correspond pas au mot de passe de confirmation');
            return redirect()->route('users.index');
        }
    }

    //EDIT FUNCCTION
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('message', "L'utilisateur supprimé avec succès");
        return redirect()->route('users.index');
    }
}
