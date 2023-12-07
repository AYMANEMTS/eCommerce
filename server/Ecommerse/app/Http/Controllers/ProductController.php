<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Permision;
use App\Models\PermissionService;
use App\Models\Product;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            if ($user) {
                $this->perGate = PermissionService::checkPermission($user, 'CRUD_product');
                Gate::authorize('has-permision', $this->perGate);
            } else {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        })->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productQuery =  Product::query()->with('category')->orderBy('created_at','desc');
        $categories = Category::with('products')->has('products')->get();
        $categorisIds = $request->input('categoris');
        $min = $request->input('min') ?? 0;
        $max = $request->input('max');
        if($request->method() == 'GET'){
            $searchInput = $request->input('search');
            if(!empty($searchInput)){
                $products = $productQuery->where('title','like','%'.$searchInput.'%');
            }
            if(!empty($categorisIds)){
                $products = $productQuery->whereIn('category_id', $categorisIds);
            }
            $products = $productQuery->where('price', '>=' ,$min);
            if(!empty($max)){
                $products = $productQuery->where('price', '<=' ,$max);
            }
        }
        $products = $productQuery->paginate(6);
        $productsPrices = $products->pluck('price')->all();
        $minPrice = empty($productsPrices) ? [0] : min($productsPrices);
        $maxPrice = empty($productsPrices) ? [10000] : max($productsPrices);
        $view = 'editor.product.index';
        if(Route::current()->getPrefix() === '/admin'){
            $view = 'admin.product.index';
        }
        return view($view,compact('products','categories','maxPrice','minPrice'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $categories = Category::all();
        $isUpdate = false;
        $view = 'editor.product.form';
        if(Route::current()->getPrefix() === '/admin'){
            $view = 'admin.product.form';
        }
        return view($view,compact('product','categories','isUpdate'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $fildes = $request->validated();
        if ($request->hasFile('image')) {
            $fildes['image'] = $request->file('image')->store('product', 'public');
        }
        $product = Product::create($fildes);
        if ($request->file('other_images')) {
            $maxFiles = 4;
        if (count($request->file('other_images')) > $maxFiles) {
            return redirect()->back()->with('error', 'You can only upload a maximum of ' . $maxFiles . ' images.');
        }
            foreach ($request->file('other_images') as $image) {
                $path = $image->store('other_images_products', 'public');
                ProductImages::create([
                    'path' => $path,
                    'product_id' => $product->id
                ]);
            }
        }
        $redirectRoute = 'products-e.index';
        if(Route::current()->getPrefix() === '/admin'){
            $redirectRoute = 'products.index';
        }
        return redirect()->route($redirectRoute)->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $product = Product::find($id);
        $view = 'editor.product.show';
        if(Route::current()->getPrefix() === '/admin'){
            $view = 'admin.product.show';
        }
        return view($view,compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $isUpdate = true;
        $view = 'editor.product.form';
        if(Route::current()->getPrefix() === '/admin'){
            $view = 'admin.product.form';
        }
        return view($view,compact('product','categories','isUpdate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, String $id)
    {
        $product = Product::find($id);
        $fildes = $request->validated();
        if ($request->hasFile('image')) {
            $fildes['image'] = $request->file('image')->store('product', 'public');
        }
        if ($request->file('other_images')) {
            if (count($request->file('other_images')) + count($product->images) > 4) {
                return redirect()->back()->with('error', 'You can only upload a maximum of 4 images.');
            }
            foreach ($request->file('other_images') as $image) {
                $path = $image->store('other_images_products', 'public');
                ProductImages::create([
                    'path' => $path,
                    'product_id' => $product->id
                ]);
            }
        }
        $product->fill($fildes)->save();
        $redirectRoute = 'products-e.index';
        if(Route::current()->getPrefix() === '/admin'){
            $redirectRoute = 'products.index';
        }
        return to_route($redirectRoute)->with('success', 'Product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $product = Product::find($id);
        $product->delete();
        $redirectRoute = 'products-e.index';
        if(Route::current()->getPrefix() === '/admin'){
            $redirectRoute = 'products.index';
        }
        return to_route($redirectRoute)->with('success', 'Product deleted successfully');
    }
}
