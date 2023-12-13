<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class CustomerController extends Controller
{
    public function index(){
        $createLink = route('customer.create');

        $users = User::role('Pelanggan')->paginate(10);

        return view('customer.index', compact('users', 'createLink'));
    }

    public function create(){
        $indexLink = route('customer.index');
        $storeLink = route('customer.store');

        return view('customer.create', compact('indexLink', 'storeLink'));
    }

    public function store(Request $request){
        $user = User::create($request->all());
        $roleCustomer = Role::findOrCreate('Pelanggan');
        $user->assignRole($roleCustomer);

        toast('Customer berhasil ditambah!', 'success');
        return redirect()->route('customer.index');
    }

    public function edit(User $customer){
        $updateLink = route('customer.update', $customer);
        $indexLink = route('customer.index');

        return view('customer.edit', compact('customer', 'updateLink', 'indexLink'));
    }

    public function update(User $customer, Request $request){
        $customer->update($request->all());

        toast('Customer berhasil diupdate!', 'success');
        return redirect()->route('customer.index');
    }

    public function destroy(User $customer){
        $customer->delete();

        toast('Customer berhasil dihapus!', 'success');
        return back();
    }
}
