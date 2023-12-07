<?php

namespace App\Http\Controllers;

use App\Models\PermissionService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            if ($user) {
                $this->perGate = PermissionService::checkPermission($user, 'CRUD_permission');
                Gate::authorize('has-permision', $this->perGate);
            } else {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        })->except(['index','show']);
    }

    public function create($id)
    {
        $userPerm = User::find($id);
        return view('permission.create',compact('userPerm'));
    }


    public function store(Request $request , $userId)
    {
        // permission li deja 3nd l user
        $checkedPermission = DB::table('permission_user')->where('user_id',$userId)->select('permission_id')->get();

        $permisionIdsRequest = $request->post();
        //permission id li jaya mn request
        $permissionArray = collect($permisionIdsRequest)->except('_token')->toArray();

        foreach ($permissionArray as $key => $perId) {
            $existingPermissions = $checkedPermission->pluck('permission_id')->toArray();
            if (!in_array($perId, $existingPermissions)) {
                $this->storeLG($perId,$userId);
            }

        }

        foreach ($checkedPermission as $key => $value){
            if(!in_array($value->permission_id,$permissionArray)){
                $this->destroyLG($value->permission_id,$userId);
            }
        }
        return back();

    }
    public function storeLG($perId,$userId)
    {
        try {
            DB::table('permission_user')->insert(['user_id'=>$userId,'permission_id'=>$perId]);
        }catch (\Exception $e){
            dd($e);
        }
    }
    public function destroyLG($perId,$userId)
    {
        try {
            DB::table('permission_user')->where('user_id',$userId)->where('permission_id',$perId)->delete();
        }catch (\Exception $e){
            dd($e);
        }
    }


}
