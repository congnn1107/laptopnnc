<?php

use Illuminate\Database\Seeder;
use App\Model\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Admin::truncate();
        $admin = new Admin();
        $admin->name="Nguyễn Ngọc Công";
        $admin->username="nncpro";
        $admin->password = Hash::make("12345678");
        $admin->save();
    }
}
