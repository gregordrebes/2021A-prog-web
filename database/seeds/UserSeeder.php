<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        DB::table("users")->insert([
            "name" => "Moderator Test",
            "email" => "moderator.test@mail.com",
            "password" => Hash::make("12345678"),
            "role_id" => "1",
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
