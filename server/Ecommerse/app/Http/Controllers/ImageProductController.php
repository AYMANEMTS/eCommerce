<?php

namespace App\Http\Controllers;

use App\Models\ProductImages;
use Illuminate\Http\Request;

class ImageProductController extends Controller
{
    public function deleteImage($imageId, $productId)
    {
        ProductImages::where("id", $imageId)->where("product_id", $productId)->delete();
        return back();
    }
}
