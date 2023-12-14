<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportTransactionController extends Controller
{
    public function index(){
        $transactions = Transaction::latest()->paginate(10);

        return view('report.transaction.index', compact('transactions'));
    }
}
