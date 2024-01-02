<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasingItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchasing_id',
        'item_id',
        'price',
        'qty',
        'total'
    ];

    public function purchasing(){
        return $this->belongsTo(Purchasing::class);
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }
}
