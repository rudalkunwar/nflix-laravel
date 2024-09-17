<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'amount', 'transaction_id', 'payment_status'];

    const PAYMENT_COMPLETED = 'completed';
    const PAYMENT_PENDING = 'pending';
    const PAYMENT_FAILED = 'failed';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
