<?php

use App\Role;
use Carbon\Doctrine\CarbonType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    private $roles = [
        "MODERATOR",
        "EDITOR"
    ];
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles as $role){
            $now = Carbon::now()->format('Y-m-d H:i:s');
            DB::table("roles")->insert([
                "name" => $role,
                'created_at' => $now,
                'updated_at' => $now

            ]);
        }
    }
}
