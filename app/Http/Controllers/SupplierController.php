<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(){
        $createLink = route('supplier.create');

        $suppliers = Supplier::latest()->paginate(10);

        return view('supplier.index', compact('suppliers', 'createLink'));
    }

    public function create(){
        $indexLink = route('supplier.index');
        $storeLink = route('supplier.store');

        return view('supplier.create', compact('indexLink', 'storeLink'));
    }

    public function store(Request $request){
        Supplier::create($request->all());

        toast('Supplier berhasil ditambah!', 'success');
        return redirect()->route('supplier.index');
    }

    public function edit(Supplier $supplier){
        $updateLink = route('supplier.update', $supplier);
        $indexLink = route('supplier.index');

        return view('supplier.edit', compact('supplier', 'updateLink', 'indexLink'));
    }

    public function update(Supplier $supplier, Request $request){
        $supplier->update($request->all());

        toast('Supplier berhasil diupdate!', 'success');
        return redirect()->route('supplier.index');
    }

    public function destroy(Supplier $supplier){
        $supplier->delete();

        toast('Supplier berhasil dihapus!', 'success');
        return back();
    }
}
