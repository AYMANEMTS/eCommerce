<?php

namespace App\Models;


class PermissionService
{
    public static function checkPermission(User $user, $targetPermission)
    {
        $perGate = '';

        foreach ($user->permisions() as $perIds) {
            $permissions = Permision::where('id', $perIds->permission_id)->get();
            foreach ($permissions as $per) {
                if ($per->name === $targetPermission) {
                    $perGate = $per->name;
                }
            }
        }
        return $perGate;
    }
}
