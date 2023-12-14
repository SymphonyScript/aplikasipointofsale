<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function index(){
        $createLink = route('product.item.create');

        $items = Item::latest()->paginate(10);

        return view('product.item.index', compact('items', 'createLink'));
    }

    public function create(){
        $indexLink = route('product.item.index');
        $storeLink = route('product.item.store');

        $categories = Category::get();
        $units = Unit::get();

        return view('product.item.create', compact('indexLink', 'storeLink', 'categories', 'units'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:items,code',
        ]);

        if ($validator->fails()) {
            toast('Kode pernah diinput!', 'warning');
            return back();
        }

        Item::create($request->all());

        toast('Item berhasil ditambah!', 'success');
        return redirect()->route('product.item.index');
    }

    public function edit(Item $item){
        $updateLink = route('product.item.update', $item);
        $indexLink = route('product.item.index');

        $categories = Category::get();
        $units = Unit::get();

        return view('product.item.edit', compact('item', 'updateLink', 'indexLink', 'categories', 'units'));
    }

    public function update(Item $item, Request $request){
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:items,code,'.$item->id,
        ]);

        if ($validator->fails()) {
            toast('Kode pernah diinput!', 'warning');
            return back();
        }

        $item->update($request->all());

        toast('Item berhasil diupdate!', 'success');
        return redirect()->route('product.item.index');
    }

    public function destroy(Item $item){
        $item->delete();

        toast('Item berhasil dihapus!', 'success');
        return back();
    }

    public function getItem(Request $request){
        $item = Item::find($request->item_id);
        return $item;
    }

    public function qr(Item $item){
        return view('product.item.qr', compact('item'));
    }
}
