<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Cooking;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;

class SaleItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SaleItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'sale_id' => Sale::factory(),
            'cooking_id' => Cooking::factory(),
            'quantity' => $this->faker->numberBetween(-10000, 10000),
            'product_price' => $this->faker->randomFloat(4, 0, 9999.9999),
            'total_product_price' => $this->faker->numberBetween(-10000, 10000),
            'cooking_price' => $this->faker->randomFloat(4, 0, 9999.9999),
            'total' => $this->faker->randomFloat(4, 0, 9999.9999),
            'created_by' => Admin::factory()->create()->created_by,
        ];
    }
}
