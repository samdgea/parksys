<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\VehicileType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $adminUser = User::create([
            'first_name' => 'Administrator',
            'email' => 'admin@abdilah.id',
            'password' => Hash::make('password'),
            'phone_number' => '081703016900',
            'employee_number' => '2021040001',
            'account_status' => true
        ]);

        $adminRole = Role::create(['name' => 'Administrator']);
        $userRole = Role::create(['name' => 'User']);

        $p1 = Permission::create(['name' => 'Manage users']);
        $p2 = Permission::create(['name' => 'Manage reports']);
        $p3 = Permission::create(['name' => 'Gate Keeper']);

        $adminRole->givePermissionTo('Manage users');
        $adminRole->givePermissionTo('Manage reports');
        $userRole->givePermissionTo(['Gate Keeper']);

        $adminUser->assignRole('Administrator');

        $hargaMotor = VehicileType::create([
            'vehicile_code' => 'C',
            'vehicile_name' => 'Motor',
            'first_hour_price' => 3000,
            'next_hour_price' => 3000,
            'is_flat_price' => false,
            'created_by' => 1,
            'updated_by' => 1
        ]);

        $hargaMobil = VehicileType::create([
            'vehicile_code' => 'A',
            'vehicile_name' => 'Mobil',
            'first_hour_price' => 5000,
            'next_hour_price' => 5000,
            'is_flat_price' => false,
            'created_by' => 1,
            'updated_by' => 1
        ]);
    }
}
