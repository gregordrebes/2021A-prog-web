<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        DB::table("categories")->insert([
            "name" => "Progamming",
            "description" => "Covers on the area of ​​programming.",
            "color" => "#40e318",
            "icon" => "code",
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}