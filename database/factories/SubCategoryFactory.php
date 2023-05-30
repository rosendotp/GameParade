<?php
namespace Database\Factories;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubcategoryFactory extends Factory
{

    protected $model = Subcategory::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'image' => 'subcategories/' . $this->faker->image('public/storage/subcategories', 640, 480, null, false) //imagen1.jpg
        ];
    }
}
