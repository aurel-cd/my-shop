<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        $user=User::create([
//            'firstName' => 'Aurel',
//            'lastName' => 'Spahiu',
//            'email' => 'admin@gmail.com',
//            'email_verified_at' => now(),
//            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
//            'phone' => 1234567890, // Replace with an appropriate value
////            'remember_token' => Str::random(10),
//        ]);
        $user = User::where('id', '1')->first();
        $adminRole = Role::where('name', 'admin')->first();

        if (!$user->hasRole($adminRole)) {
            $user->assignRole($adminRole);
        }
    }

}
