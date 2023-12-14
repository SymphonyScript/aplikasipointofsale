<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(){
        $createLink = route('user.create');

        $users = User::whereHas('roles', function ($query) {
                    $query->where('name', '!=', 'Pelanggan');
                })->paginate(10);

        return view('user.index', compact('users', 'createLink'));
    }

    public function create(){
        $indexLink = route('user.index');
        $storeLink = route('user.store');

        $roles = Role::get();

        return view('user.create', compact('indexLink', 'storeLink', 'roles'));
    }

    public function store(Request $request){
        $request->merge([
            'password' => Hash::make($request->password)
        ]);

        $user = User::create($request->all());
        $roleuser = Role::find($request->role);
        $user->assignRole($roleuser);

        toast('User berhasil ditambah!', 'success');
        return redirect()->route('user.index');
    }

    public function edit(User $user){
        $updateLink = route('user.update', $user);
        $indexLink = route('user.index');

        $roles = Role::get();

        return view('user.edit', compact('user', 'updateLink', 'indexLink', 'roles'));
    }

    public function update(User $user, Request $request){
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->update($request->all());

        $role = Role::find($request->role);
        $user->assignRole($role);

        toast('User berhasil diupdate!', 'success');
        return redirect()->route('user.index');
    }

    public function destroy(User $user){
        $user->delete();

        toast('User berhasil dihapus!', 'success');
        return back();
    }
}
