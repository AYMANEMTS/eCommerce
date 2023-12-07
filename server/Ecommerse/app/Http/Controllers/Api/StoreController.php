<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::with('category')->orderBy('created_at', 'desc')->paginate(10);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Product::with('category', 'images', 'sections')->find($id);
    }


    public function categoryItems()
    {
        $catos = Category::with('products')->has('products')->get();
        return $catos;
    }

    public function lastProducts()
    {
        return Product::with('category')->orderBy('created_at','desc')->take(4)->get();
    }

    public function storeOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullName' => 'required|max:100',
            'email' => 'required|email',
            'phone' => 'required|max:15',
            'address' => 'required|max:200',
            'product_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'failed', 'errors' => $validator->errors()], 422);
        }
        $data = $validator->validated();
        $data['status'] = 'fresh';
        $order = OrderProduct::create($data);
        if ($order) {
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'failed', 'errors' => 'Failed to create order.']);
    }




}
