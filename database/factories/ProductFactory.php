<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Unit;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'type' => $this->faker->randomElement(["material","ready","made"]),
            'made_in_order' => $this->faker->boolean(),
            'image' => $this->faker->word(),
            'selling_price' => $this->faker->randomFloat(4, 0, 9999.9999),
            'is_active' => $this->faker->boolean(),
            'created_by' => Admin::query()->inRandomOrder()->first()->id,
            'unit_id' => Unit::factory(),
        ];
    }
}
