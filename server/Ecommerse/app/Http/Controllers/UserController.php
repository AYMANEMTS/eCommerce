<?php

namespace App\Http\Controllers;

use App\Models\PermissionService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $perGate = PermissionService::checkPermission($user,'VIEW_users');
        Gate::authorize('has-permision',$perGate);
        $users = User::orderBy('created_at', 'desc')->get();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $perGate = PermissionService::checkPermission($user,'CREATE_users');
        Gate::authorize('has-permision',$perGate);
        $isUpdate = false;
        $user = new User();
        return view('users.form',compact('isUpdate','user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $perGate = PermissionService::checkPermission($user,'CREATE_users');
        Gate::authorize('has-permision',$perGate);
        $data = $request->validate([
            'name' => 'required|max:150',
            'email' => 'required|email',
            'password' => 'required|max:150|min:8',
            'password_confirmation' => 'required|same:password'
        ]);
        $password = Hash::make($request->password);
        User::create([
            'role' => 'editor',
           'name' => $request->name ,
           'email' => $request->email ,
           'password' => $password ,
        ]);
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('users.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user = Auth::user();
        $perGate = PermissionService::checkPermission($user,'CREATE_users');
        Gate::authorize('has-permision',$perGate);
        $isUpdate = true;
        return view('users.form',compact('user','isUpdate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user = Auth::user();
        $perGate = PermissionService::checkPermission($user,'CREATE_users');
        Gate::authorize('has-permision',$perGate);
        $request->validate(['name'=>'required']);
        if(!$request->email === $user->email){
            $request->validate(['email'=>'required|email|unique:users,email,{$user->id}']);
        }
        $user->update($request->only('name','email'));
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $user = Auth::user();
        $perGate = PermissionService::checkPermission($user,'DELETE_users');
        Gate::authorize('has-permision',$perGate);
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

}
