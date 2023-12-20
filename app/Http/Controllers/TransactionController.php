<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
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
            'cashier_id' => Auth::user()->id,
            'total' => $request->grand_total,
            'customer_id' => $request->customer
        ]);

        foreach ($request->item as $key => $item){
            $item = Item::find($item);

            $item->update([
                'stock' => $item->stock - $request->qty[$key]
            ]);

            TransactionItem::create([
                'item_id' => $item->id,
                'transaction_id' => $transaction->id,
                'price' => $request->price[$key],
                'qty' => $request->qty[$key],
                'total' => $request->total[$key],
            ]);
        }

        toast('Transaksi berhasil ditambah!', 'success');
        return redirect()->route('report.transaction.note', $transaction);
    }

    public function destroy(Transaction $transaction){
        foreach ($transaction->items as $item){
            $product = Item::find($item->item_id);

            $product->update([
                'stock' => $product->stock + $item->qty
            ]);
        }

        toast('Transaksi berhasil dihapus!', 'success');
        return back();
    }

    public function statistic(){
        for ($month = 1; $month <= 12; $month++) {
            $transactionData = Transaction::when(\request('year'), function ($query) {
                $query->whereYear('created_at', \request('year'));
            })
                ->whereMonth('created_at', $month)
                ->selectRaw('COUNT(*) as transaction_count, COALESCE(SUM(total), 0) as total_amount')
                ->first();

            $months[] = $month;
            $transactionCounts[] = $transactionData->transaction_count ?? 0;
            $totalAmounts[] = $transactionData->total_amount ?? 0;

        }

        $result = [
            'months' => $months,
            'transaction_counts' => $transactionCounts,
            'total_amounts' => $totalAmounts
        ];

        return $result;
    }
}
