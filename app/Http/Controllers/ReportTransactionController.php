<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class ReportTransactionController extends Controller
{
    public function index(PDF $PDF){
        $transactions = Transaction::latest();

        if(\request('download_type')){
            $transactions = $transactions->get();
            $pdf = $PDF->loadView('report.transaction.pdf', compact('transactions'))
                ->setPaper('A4')
                ->stream('Laporan Transaksi.pdf');

            return $pdf;
        }

        $transactions = $transactions->paginate(10);

        return view('report.transaction.index', compact('transactions'));
    }
}
