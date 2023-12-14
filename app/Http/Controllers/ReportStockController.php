<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class ReportStockController extends Controller
{
    public function in(){
        $stocks = Stock::latest()->where('type', Stock::IN)->paginate(10);

        return view('report.stock.in', compact('stocks'));
    }

    public function out(){
        $stocks = Stock::latest()->where('type', Stock::OUT)->paginate(10);

        return view('report.stock.out', compact('stocks'));
    }
}
