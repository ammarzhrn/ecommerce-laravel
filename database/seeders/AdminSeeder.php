<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new \App\Models\User;
        $user->name = 'Ammar Zahran';
        $user->email = 'ammarzann@gmail.com'; 
        $user->level = 'admin'; 
        $user->password = 12345678;
        $user->save();
    }
}
