<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'status',
        'transactionDate',
        'amount',
        'payment_method',
        'order_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
