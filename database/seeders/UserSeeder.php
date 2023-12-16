<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();

        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@pointofsale.com',
            'password' => Hash::make('pos123'),
        ]);

        $cashier = User::create([
            'name' => 'Kasir',
            'email' => 'cashier@pointofsale.com',
            'password' => Hash::make('cashier123'),
        ]);

        $customer = User::create([
            'name' => 'Pelanggan',
            'email' => 'member@pointofsale.com',
            'password' => Hash::make('pelanggan'),
        ]);

        $roleAdmin = Role::findOrCreate('Super Admin');
        $roleCashier = Role::findOrCreate('Kasir');
        $roleCustomer = Role::findOrCreate('Pelanggan');

        $admin->assignRole($roleAdmin);
        $cashier->assignRole($roleCashier);
        $customer->assignRole($roleCustomer);

        Schema::enableForeignKeyConstraints();
    }
}
