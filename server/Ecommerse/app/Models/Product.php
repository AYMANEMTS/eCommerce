<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['title', 'price', 'image', 'description', 'quantity',
    'category_id','befor_price','payement_method',];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImages::class,'product_id');
    }
    public function sections()
    {
        return $this->hasMany(ProductSection::class,'product_id');
    }
    public function orders()
    {
        return $this->hasMany(OrderProduct::class,'product_id');
    }
    public function payments()
    {
        return $this->hasMany(PaymentSuccess::class,'product_id');
    }
}
