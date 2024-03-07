<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permision;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\DB;

class PermisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'CRUD_category','VIEW_orders',
            'EDIT_orders','DELETE_orders',
            'VIEW_payments','CRUD_payment',
            'CRUD_permission','CRUD_product',
            'VIEW_users','CREATE_users',
            'DELETE_users'
        ];
        try {
            foreach ($data as $perName ) {
                DB::table('permisions')->insert(['name'=>$perName]);
            }
        } catch (\Exception $e) {
            throw $e;
        }
        try {
            $permissions = Permision::all();
            foreach ($permissions as $per ) {
                DB::table('permission_user')->insert(['user_id'=>1,'permission_id'=>$per->id]);
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
