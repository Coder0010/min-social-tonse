<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::table("users")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::table("password_resets")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

        User::create([
            "name"              => config("system.developer.name"),
            "email"             => config("system.developer.email"),
            "password"          => \Hash::make(config("system.developer.password")),
        ]);
        User::create([
            "name"              => config("system.company.name"),
            "email"             => config("system.company.email"),
            "password"          => \Hash::make(config("system.company.password")),
        ]);
    }
}
