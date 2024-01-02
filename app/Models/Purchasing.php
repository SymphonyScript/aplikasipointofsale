<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchasing extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'supplier_id',
        'total',
        'status'
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function items(){
        return $this->hasMany(PurchasingItem::class, 'purchasing_id');
    }
}
