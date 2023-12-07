<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class CategoryController extends Controller
{
    protected $perGate;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            if ($user) {
                $this->perGate = PermissionService::checkPermission($user, 'CRUD_category');
                Gate::authorize('has-permision', $this->perGate);
            } else {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        })->except('index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $view = 'editor.category.index';
        if(Route::current()->getPrefix() === '/admin'){
            $view = 'admin.category.index';
        }
        $categories =  Category::paginate(10);
        return view($view,compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $view = 'editor.category.form';
        if(Route::current()->getPrefix() === '/admin'){
            $view = 'admin.category.form';
        }
        $isUpdate = false;
        $category = new Category();
        return view($view,compact('isUpdate','category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $redirectRoute = 'categories.index';
        if(Route::current()->getPrefix() === '/admin'){
            $redirectRoute = 'category.index';
        }
        $filds = $request->validated();
        Category::create($filds);
        return to_route($redirectRoute)->with('success', 'Category created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $view = 'editor.category.show';
        if(Route::current()->getPrefix() === '/admin'){
            $view = 'admin.category.show';
        }
        $products = $category->products()->get();
        return view($view,compact('category','products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $isUpdate = true;
        $view = 'editor.category.form';
        if(Route::current()->getPrefix() === '/admin'){
            $view = 'admin.category.form';
        }
        return view($view,compact('isUpdate','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->fill($request->validated())->save();
        $redirectRoute = 'categories.index';
        if(Route::current()->getPrefix() === '/admin'){
            $redirectRoute = 'category.index';
        }
        return to_route($redirectRoute)->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        $redirectRoute = 'categories.index';
        if(Route::current()->getPrefix() === '/admin'){
            $redirectRoute = 'category.index';
        }
        return to_route($redirectRoute);
    }
}
