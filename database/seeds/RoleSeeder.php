<?php

use Illuminate\Database\Seeder;
use App\Model\Role;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::truncate();
        $role = new Role();
        $role->name = "System Admin";
        $role->save();
        $role = new Role();
        $role->name = "Admin";
        $role->save();
    }
}
