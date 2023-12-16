<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $transactions = Transaction::latest()->get()->take(5);
        $items = Item::orderBy('stock')->take(5)->get();
        $sellings = Item::withCount(['sellings as total_sold' => function ($query) {
                $query->select(DB::raw('SUM(qty)'));
            }])
            ->orderByDesc('total_sold')
            ->get()
            ->take(5);

        return view('dashboard', compact('transactions', 'items' , 'sellings'));
    }
}
