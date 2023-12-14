<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(){
        $createLink = route('product.unit.create');

        $units = Unit::latest()->paginate(10);

        return view('product.unit.index', compact('units', 'createLink'));
    }

    public function create(){
        $indexLink = route('product.unit.index');
        $storeLink = route('product.unit.store');

        return view('product.unit.create', compact('indexLink', 'storeLink'));
    }

    public function store(Request $request){
        Unit::create($request->all());

        toast('Unit berhasil ditambah!', 'success');
        return redirect()->route('product.unit.index');
    }

    public function edit(Unit $unit){
        $updateLink = route('product.unit.update', $unit);
        $indexLink = route('product.unit.index');

        return view('product.unit.edit', compact('unit', 'updateLink', 'indexLink'));
    }

    public function update(Unit $unit, Request $request){
        $unit->update($request->all());

        toast('Unit berhasil diupdate!', 'success');
        return redirect()->route('product.unit.index');
    }

    public function destroy(Unit $unit){
        $unit->delete();

        toast('Unit berhasil dihapus!', 'success');
        return back();
    }
}
