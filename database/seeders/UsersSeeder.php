<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Services\Roles\Role;
use App\Services\Users\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::get();

        foreach ($roles as $role) {
            User::create([
                'full_name' => 'John ' . $role->role_name,
                'email' => 'John' . str_replace(' ', '', $role->role_name) . '@email.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
                'role_id' => $role->id,
            ]);
        }
    }
}
