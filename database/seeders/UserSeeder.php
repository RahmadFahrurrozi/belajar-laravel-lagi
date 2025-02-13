<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();
        User::factory()
            ->count(10)
            ->create();
        // $users =[];
        // for ($i = 1; $i <= 10; $i++) {
        //     $users[] = [
        //         'name' => 'User' . Str::random(10). 'Ke-' .$i,
        //         'email' => 'user' . Str::random(10) . $i . '@example.com',
        //         'password' => Hash::make('password'),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];
        // }
        // DB::table('users')->insert($users);
    }
}
