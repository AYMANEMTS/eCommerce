
@php
    use Illuminate\Support\Facades\Route;

    $isAdminRoute = (Route::is('admin.home'));
    $isCategoriesRoute = (Route::is('category*'));
    $isProductsRoute = (Route::is('products.*'));
    $isUsersRoute = (Route::is('users.*'));
    $isOrdersRoute = (Route::is('orders.*'));
    $isPaymentRoute = (Route::is('payments.*'));
    $defaultClasses = 'list-group-item list-group-item-action';
@endphp

<div class="list-group">
    <a @class([$defaultClasses, 'active' => $isAdminRoute]) href="{{ route('admin.home') }}">Dashbord</a>
    <a @class([$defaultClasses, 'active' => $isProductsRoute]) href="{{ route('products.index')}}">Product</a>
    <a @class([$defaultClasses, 'active' => $isCategoriesRoute]) href="{{ route('category.index') }}">Categories</a>
    <a @class([$defaultClasses, 'active' => $isUsersRoute]) href="{{ route('users.index') }}">Users</a>
    <a @class([$defaultClasses, 'active' => $isOrdersRoute]) href="{{ route('orders.index') }}">Orders</a>
    <a @class([$defaultClasses, 'active' => $isPaymentRoute]) href="{{ route('payments.index') }}">Payments</a>

</div>

@yield('filters')
