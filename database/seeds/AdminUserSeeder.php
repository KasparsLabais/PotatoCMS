<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')
            ->insert([
                "email" => "admin@admin.com",
                "username" => "Admin",
                "password" => bcrypt("password"),
                "access_level" => 30
            ]);
    }
}
