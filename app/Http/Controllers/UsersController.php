<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index()
    {
        $data['users'] = User::latest()->get();

        return view('user.index', $data);
    }

    public function create()
    {
        return view('user.form');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validate();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role']
        ]);

        return redirect()->back()->with('info', 'Akun baru berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        return view('user.form', compact('user'));
    }

    public function update(Request $request, User $user) 
    {
        $data = $request->all();

        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'string'],
        ])->validate();

        $user->update($data);

        return redirect()->back()->with('info', 'Akun berhasil di-update!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('info', 'Akun berhasil dihapus!');
    }

    public function changePassword(Request $request, $id) 
    {
        $data = $request->all();

        Validator::make($data, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validate();

        $user = User::find($id);
        $user->password = Hash::make($data['password']);
        $user->save();

        return redirect()->back()->with('info', 'Password Akun berhasil di-update!');
    }
}
