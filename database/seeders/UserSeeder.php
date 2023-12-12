<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@pointofsale.com',
            'password' => Hash::make('pos123'),
        ]);

        $customer = User::create([
            'name' => 'Pelanggan',
            'email' => 'member@pointofsale.com',
            'password' => Hash::make('pelanggan'),
        ]);

        $roleAdmin = Role::findOrCreate('Super Admin');
        $roleCustomer = Role::findOrCreate('Pelanggan');

        $admin->assignRole($roleAdmin);
        $customer->assignRole($roleCustomer);
    }
}
