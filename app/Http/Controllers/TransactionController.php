<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(){
        $createLink = route('supplier.create');

        $suppliers = Supplier::latest()->paginate(10);

        return view('supplier.index', compact('suppliers', 'createLink'));
    }

    public function create(){
        $storeLink = route('transaction.store');

        $items  = Item::get();

        $year = date("Y");
        $month = date("m");
        $count = Transaction::get()->count();
        $code = 'TRX/'.$month.'/'.$year.'/'.sprintf('%04d', $count);

        return view('transaction.create', compact('storeLink', 'code', 'items'));
    }

    public function store(Request $request){
        dd($request->all());
        $year = date("Y");
        $month = date("m");
        $count = Transaction::get()->count();
        $code = 'TRX/'.$month.'/'.$year.'/'.sprintf('%04d', $count);

        Transaction::create([
            'code' => $code
            'ca'
        ]);

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
