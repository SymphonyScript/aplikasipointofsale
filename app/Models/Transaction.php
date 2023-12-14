<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'casier_id',
        'total',
        'status',
        'customer_id'
    ];

    public function casier(){
        return $this->belongsTo(User::class, 'casier_id')->withDefault();
    }

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id');
    }
}
