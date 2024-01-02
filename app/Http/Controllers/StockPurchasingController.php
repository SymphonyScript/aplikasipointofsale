<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchasing;
use App\Models\PurchasingItem;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockPurchasingController extends Controller
{
    public function index(PDF $PDF){
        $createLink = route('stock.purchasing.create');

        $transactions = Purchasing::latest();

//        if(\request('download_type')){
//            $transactions = $transactions->get();
//            $pdf = $PDF->loadView('report.transaction.pdf', compact('transactions'))
//                ->setPaper('A4')
//                ->stream('Laporan Transaksi.pdf');
//
//            return $pdf;
//        }

        $transactions = $transactions->paginate(10);

        return view('stock.purchasing.index', compact('transactions', 'createLink'));
    }

    public function create(){
        $indexLink = route('stock.in.index');
        $storeLink = route('stock.purchasing.store');

        $suppliers = Supplier::get();
        $items = Item::get();
        $users = Supplier::get();

        return view('stock.purchasing.create', compact('indexLink', 'storeLink', 'suppliers', 'items', 'users'));
    }

    public function store(Request $request){
        $year = date("Y");
        $month = date("m");
        $count = Purchasing::get()->count();
        $code = 'PMB/'.$month.'/'.$year.'/'.sprintf('%04d', $count);

        $purchasing = Purchasing::create([
            'code' => $code,
            'supplier_id' => $request->supplier_id,
            'total' => $request->grand_total,
            'status' => 'PEMBELIAN'
        ]);

        foreach ($request->item as $key => $item){
            $item = Item::find($item);

            $item->update([
                'stock' => $item->stock + $request->qty[$key]
            ]);

            PurchasingItem::create([
                'item_id' => $item->id,
                'purchasing_id' => $purchasing->id,
                'price' => $request->price[$key],
                'qty' => $request->qty[$key],
                'total' => $request->total[$key],
            ]);
        }

        toast('Pembelian berhasil ditambah!', 'success');
        return back();
    }

    public function show(Purchasing $purchasing){
        return view('stock.purchasing.show', compact('purchasing'));
    }
}
