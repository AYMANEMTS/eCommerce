<?php

namespace App\Http\Controllers;

use App\Models\PaymentSuccess;
use App\Models\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PaymentSuccessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $perGate = PermissionService::checkPermission($user,'VIEW_payments');
        Gate::authorize('has-permision',$perGate);
        $payments = PaymentSuccess::with('product')->orderBy('created_at', 'desc')->get();
        return view('online.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('online.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentSuccess $paymentSuccess)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentSuccess $paymentSuccess)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentSuccess $payment)
    {
        $user = Auth::user();
        $perGate = PermissionService::checkPermission($user,'CRUD_payment');
        Gate::authorize('has-permision',$perGate);
        $payment->delete();
        return back();
    }
}
