<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
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
        DB::table('admins')->where('role', Admin::ROLE[0])->delete();
        DB::table('admins')->insert([
            'name' => config('superadmin.name'),
            'email' => config('superadmin.email'),
            'password' => Hash::make(config('superadmin.password')),
            'role' => Admin::ROLE[0],
        ]);
    }
}
