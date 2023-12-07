<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $table = 'order_products';
    protected $fillable = ['fullName','email','phone','address','product_id','status'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
