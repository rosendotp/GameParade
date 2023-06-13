<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $role = Role::create(['name' => 'admin']);

        User::create([
            'name' => 'Rosendo',
            'email' => 'r.t.p@hotmail.es',
            'password' => bcrypt('12345678')
        ])->assignRole('admin');


        User::factory(100)->state(function () {
            return [
                'password' => Hash::make('12345678'),
            ];
        })->create();
    }
}
