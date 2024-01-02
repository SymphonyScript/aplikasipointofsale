<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    const PURCHASING = 'PEMBELIAN';
    const IN = 'IN';
    const OUT = 'OUT';

    protected $fillable = [
        'type',
        'supplier_id',
        'item_id',
        'qty',
        'description'
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id')->withDefault();
    }

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }
}
