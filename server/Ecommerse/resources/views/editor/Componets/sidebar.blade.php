@php
    use Illuminate\Support\Facades\Route;

    $isAdminRoute = (Route::is('editor.dashbord'));
    $isCategoriesRoute = (Route::is('categories.*'));
    $isProductsRoute = (Route::is('products-e.*'));
    $isUsersRoute = (Route::is('users.*'));
    $isOrdersRoute = (Route::is('orders.*'));
    $isPaymentRoute = (Route::is('payments.*'));
    $defaultClasses = 'list-group-item list-group-item-action';
@endphp

<div class="list-group">
    <a @class([$defaultClasses, 'active' => $isAdminRoute]) href="{{route('editor.dashbord')}}">Dashbord</a>
    <a @class([$defaultClasses, 'active' => $isProductsRoute]) href="{{route('products-e.index')}}" >Product</a>
    <a @class([$defaultClasses, 'active' => $isCategoriesRoute]) href="{{ route('categories.index') }}" >Categories</a>
    @if(Auth::user()->hasPermision('VIEW_users'))
        <a @class([$defaultClasses, 'active' => $isUsersRoute]) href="{{ route('users.index') }}">Users</a>
    @endif
    @if(Auth::user()->hasPermision('VIEW_orders'))
        <a @class([$defaultClasses, 'active' => $isOrdersRoute]) href="{{ route('orders.index') }}">Orders</a>
    @endif
    @if(Auth::user()->hasPermision('VIEW_payments'))
        <a @class([$defaultClasses, 'active' => $isPaymentRoute]) href="{{ route('payments.index') }}">Payments</a>
    @endif
</div>

@yield('filters')
