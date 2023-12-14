<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
    public function index(){
        $createLink = route('stock.out.create');

        $stocks = Stock::latest()->where('type', Stock::OUT)->paginate(10);

        return view('stock.out.index', compact('stocks', 'createLink'));
    }

    public function create(){
        $indexLink = route('stock.out.index');
        $storeLink = route('stock.out.store');

        $suppliers = Supplier::get();
        $items = Item::get();

        return view('stock.out.create', compact('indexLink', 'storeLink', 'suppliers', 'items'));
    }

    public function store(Request $request){
        $request->merge([
            'type' => Stock::OUT
        ]);

        $stock = Stock::create($request->all());
        $item = Item::find($stock->item->id);

        $item->update([
            'stock' => $item->stock - $stock->qty
        ]);

        toast('Stok berhasil ditambah!', 'success');
        return redirect()->route('stock.out.index');
    }

    public function edit(Stock $stock){
        $updateLink = route('stock.out.update', $stock);
        $indexLink = route('stock.out.index');

        $suppliers = Supplier::get();
        $items = Item::get();

        return view('stock.out.edit', compact('stock', 'updateLink', 'indexLink', 'suppliers', 'items'));
    }

    public function update(Stock $stock, Request $request){
        $stock->update($request->all());

        toast('Stok berhasil diupdate!', 'success');
        return redirect()->route('stock.out.index');
    }

    public function destroy(Stock $stock){
        $stock->delete();

        $item = Item::find($stock->item->id);
        $item->update([
            'stock' => $item->stock + $stock->qty
        ]);

        toast('Stok berhasil dihapus!', 'success');
        return back();
    }
}
