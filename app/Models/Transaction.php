<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'cashier_id',
        'total',
        'customer_id'
    ];

    public function cashier(){
        return $this->belongsTo(User::class, 'cashier_id')->withDefault();
    }

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function items(){
        return $this->hasMany(TransactionItem::class, 'transaction_id');
    }
}
