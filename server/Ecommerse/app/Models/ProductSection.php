<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSection extends Model
{
    use HasFactory;
    protected $table = 'product_sections';
    protected $fillable = ['product_id','nameOfSection','section'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
