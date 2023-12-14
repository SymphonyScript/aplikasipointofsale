<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    public function index(){
        $createLink = route('stock.in.create');

        $stocks = Stock::latest()->where('type', Stock::IN)->paginate(10);

        return view('stock.in.index', compact('stocks', 'createLink'));
    }

    public function create(){
        $indexLink = route('stock.in.index');
        $storeLink = route('stock.in.store');

        $suppliers = Supplier::get();
        $items = Item::get();

        return view('stock.in.create', compact('indexLink', 'storeLink', 'suppliers', 'items'));
    }

    public function store(Request $request){
        $request->merge([
            'type' => Stock::IN
        ]);

        $stock = Stock::create($request->all());
        $item = Item::find($stock->item->id);

        $item->update([
            'stock' => $item->stock + $stock->qty
        ]);

        toast('Stok berhasil ditambah!', 'success');
        return redirect()->route('stock.in.index');
    }

    public function edit(Stock $stock){
        $updateLink = route('stock.in.update', $stock);
        $indexLink = route('stock.in.index');

        $suppliers = Supplier::get();
        $items = Item::get();

        return view('stock.in.edit', compact('stock', 'updateLink', 'indexLink', 'suppliers', 'items'));
    }

    public function update(Stock $stock, Request $request){
        $stock->update($request->all());

        toast('Stok berhasil diupdate!', 'success');
        return redirect()->route('stock.in.index');
    }

    public function destroy(Stock $stock){
        $stock->delete();

        $item = Item::find($stock->item->id);
        $item->update([
            'stock' => $item->stock - $stock->qty
        ]);

        toast('Stok berhasil dihapus!', 'success');
        return back();
    }
}
