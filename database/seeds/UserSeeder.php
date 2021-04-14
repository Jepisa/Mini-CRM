<?php

use App\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'name' => 'Daniel Francesh',
            'email' => 'admin@admin.com',
            'role_id' => Role::firstWhere('name', 'Admin')->id,
            //por default la contraseña es "password"
        ]);
    }
}
