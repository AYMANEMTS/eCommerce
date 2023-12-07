<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use App\Models\PaymentSuccess;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function dashboard()
    {
//        $startDate = Carbon::now()->startOfWeek(); // Start of the current week
//        $endDate = Carbon::now()->endOfWeek();     // End of the current week
//        $ordersOfTheWeek = OrderProduct::whereBetween('created_at', [$startDate, $endDate])->get();
//        $paymentOfTheWeek = PaymentSuccess::whereBetween('created_at', [$startDate, $endDate])->get();
        $ordersOfTheWeek = OrderProduct::all();
        $paymentOfTheWeek = PaymentSuccess::all();
        $checkedOrdersOfTheWeek = OrderProduct::where('status','checked')->get();
        $revenueOfOrders = 0;
        foreach (OrderProduct::where('status','checked')->get() as $order){
            $revenueOfOrders += $order->product->price;
        }
        $revenuOfPayment = 0;
        foreach (PaymentSuccess::all() as $payment){
            $revenuOfPayment += $payment->product->price * $payment->product_qty;
        }
        return view('admin.dashboard',compact('ordersOfTheWeek','paymentOfTheWeek',
        'checkedOrdersOfTheWeek','revenueOfOrders','revenuOfPayment'));
    }
}
