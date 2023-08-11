<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $user = new User();
        $user->name = 'Staff';
        $user->email = '123@staff.atmc.edu.au';
        $user->role = 'staff';
        $user->user_level = 1;
        $user->password = bcrypt('staff@123');

        $user->save();
    }
}
