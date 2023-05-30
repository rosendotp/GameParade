<?php

namespace Database\Seeders;

use App\Models\Town;
use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Department::factory(8)->create()->each(function (Department $department) {
            Town::factory(8)->create([
                'department_id' => $department->id
            ]);
        });
        
    }
}
