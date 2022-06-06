<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Inventory;
use App\Models\InventoryItem;
use App\Models\Product;

class InventoryItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InventoryItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'inventory_id' => Inventory::factory(),
            'product_id' => Product::factory(),
            'storage_quantity' => $this->faker->numberBetween(-10000, 10000),
            'exists_quantity' => $this->faker->randomNumber(),
        ];
    }
}
