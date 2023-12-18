<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class ReportStockController extends Controller
{
    public function in(PDF $PDF){
        $stocks = Stock::latest()->where('type', Stock::IN);

        if(\request('download_type')){
            $stocks = $stocks->get();
            $pdf = $PDF->loadView('report.stock.in-pdf', compact('stocks'))
                ->setPaper('A4')
                ->stream('Laporan Stock In.pdf');

            return $pdf;
        }

        $stocks = $stocks->paginate(10);
        return view('report.stock.in', compact('stocks'));
    }
    public function out(PDF $PDF){
        $stocks = Stock::latest()->where('type', Stock::OUT);

        if(\request('download_type')){
            $stocks = $stocks->get();
            $pdf = $PDF->loadView('report.stock.out-pdf', compact('stocks'))
                ->setPaper('A4')
                ->stream('Laporan Stock Out.pdf');

            return $pdf;
        }

        $stocks = $stocks->paginate(10);

        return view('report.stock.out', compact('stocks'));
    }
}
