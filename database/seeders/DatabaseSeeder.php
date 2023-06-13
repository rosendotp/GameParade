<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Platform;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SubcategorySeeder::class);

        $this->call(ProductSeeder::class);
        $this->call(PlatformSeeder::class);

        $this->call(PlatformProductSeeder::class);
        $this->call(EditionSeeder::class);

        $this->call(DepartmentSeeder::class);
    }
}
