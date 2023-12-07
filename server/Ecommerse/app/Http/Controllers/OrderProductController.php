<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use App\Models\PermissionService;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OrderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $perGate = PermissionService::checkPermission($user,'VIEW_orders');
        Gate::authorize('has-permision',$perGate);
        if (!empty($request->filterWithProduct)){
            $productName = $request->filterWithProduct;
            $product = Product::where('title','like','%' . $productName . '%')->first();
            if ($product){
                $orders = OrderProduct::query()->where('product_id',$product->id)
                    ->orderBy('created_at','desc')->get();
            }
        }else{
            $orders = OrderProduct::query()->orderBy('created_at','desc')->get();

        }
        return view('orders.index',compact('orders'));
    }

    public function changeStatus(string $id)
    {
        $user = Auth::user();
        $perGate = PermissionService::checkPermission($user,'EDIT_orders');
        Gate::authorize('has-permision',$perGate);
        $order = OrderProduct::find($id);
        $order->update(['status'=>'checked']);
        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $perGate = PermissionService::checkPermission($user,'DELETE_orders');
        Gate::authorize('has-permision',$perGate);
        $order = OrderProduct::find($id);
        $order->delete();
        return redirect()->route('orders.index');
    }

}
