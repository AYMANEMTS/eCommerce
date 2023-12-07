<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentSuccess extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'payment_successes';
    protected $fillable = [
        'user_name','user_email','user_phone','user_address','product_id','product_qty'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
