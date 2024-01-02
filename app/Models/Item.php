<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'price',
        'purchase_price',
        'stock',
        'unit_id',
        'category_id'
    ];

    public function sellings(){
        return $this->hasMany(TransactionItem::class, 'item_id');
    }

    public function unit(){
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}
