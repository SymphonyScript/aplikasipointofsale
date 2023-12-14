<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function create(){
        $storeLink = route('transaction.store');

        $items  = Item::get();
        $users = User::role('Pelanggan')->get();

        $year = date("Y");
        $month = date("m");
        $count = Transaction::get()->count();
        $code = 'TRX/'.$month.'/'.$year.'/'.sprintf('%04d', $count);

        return view('transaction.create', compact('storeLink', 'code', 'items', 'users'));
    }

    public function store(Request $request){
        $year = date("Y");
        $month = date("m");
        $count = Transaction::get()->count();
        $code = 'TRX/'.$month.'/'.$year.'/'.sprintf('%04d', $count);

        $transaction = Transaction::create([
            'code' => $code,
            'casier_id' => Auth::user()->id,
            'total' => $request->grand_total,
            'customer_id' => $request->customer
        ]);

        foreach ($request->item as $key => $item){
            TransactionItem::create([
                'item_id' => $item,
                'transaction_id' => $transaction->id,
                'price' => $request->price[$key],
                'qty' => $request->qty[$key],
                'total' => $request->total[$key],
            ]);
        }

        toast('Transaksi berhasil ditambah!', 'success');
        return redirect()->route('transaction.create');
    }
}
