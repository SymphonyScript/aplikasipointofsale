<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'transaction_id',
        'price',
        'qty',
        'total'
    ];

    public function transaction(){
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }
}
