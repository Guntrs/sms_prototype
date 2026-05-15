<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Crear Roles (sin duplicar)
        |--------------------------------------------------------------------------
        */

        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'supervisor']);
        Role::firstOrCreate(['name' => 'empleado']);
        Role::firstOrCreate(['name' => 'cliente']);

        /*
        |--------------------------------------------------------------------------
        | Crear Usuario Admin
        |--------------------------------------------------------------------------
        */

        $user = User::firstOrCreate(
            [
                'email' => 'admin@sms.com'
            ],
            [
                'name' => 'Admin SMS',
                'password' => Hash::make('admin123'),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Asignar Rol
        |--------------------------------------------------------------------------
        */

        if (!$user->hasRole('admin')) {
            $user->assignRole('admin');
        }
    }
}
