<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login', ['title' => 'Login']);
    }
    
    public function register()
    {
        return view('auth.register', ['title' => 'Register']);
    }
    
    public function show(User $user)
    {
        return view('profile.main', [
            'title' => 'Profile',
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'username'=> 'required|min:5',
            'email'=> 'required|email:dns|unique:users',
            'password'=> 'required|min:6',
            'accpassword'=> 'required|same:password',
        ]);
        
        $validateData['password'] = Hash::make($validateData['password']);
        User::create($validateData);
        return redirect('/login')->with('register_success', 'Anda baru saja melakukan resgistrasi akun, silahkan login!!');
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'username'=> 'required|min:3',
            'date_of_birth'=> 'required',
            'phone'=> 'required|min:5||max:13',
        ];

        if ($request->email != $user->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }

        $validateData = $request->validate($rules);
        $validateData['dob'] = $request->date_of_birth;
        unset($validateData['date_of_birth']);
        User::where('id', $user->id)->update($validateData);
        return redirect('/profile/'.$user->id)->with('editProfile_success', 'Data has been updated.');
    }

    public function updateAvatar(Request $request, User $user)
    {
        if ($request->file('image')) {
            $rules = [
                'image'=> 'required|mimes:jpg,png,webp,gif',
            ];
            $validateData = $request->validate($rules);
            
            if ($request->oldImage) {
                Storage::delete('/images/user/'.$request->oldImage); 
            }

            $file = $request->file('image')->getClientOriginalName();
            $fileName = time().'-'.$file;
            $path = $request->file('image')->storeAs('images/user', $fileName);
            $validateData['image'] = $fileName;
            User::where('id', $user->id)->update($validateData);
        }

        return redirect('/profile/'.$user->id)->with('editProfile_success', 'Data has been updated.');
    }
    
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
 
        return back()->with('login_error', 'Login failed.');
    }

    public function logout()
    {
        Auth::logout();
    
        request()->session()->invalidate();
    
        request()->session()->regenerateToken();
    
        return redirect('/');
    }
}
