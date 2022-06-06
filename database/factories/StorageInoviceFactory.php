<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CreatedBy;
use App\Models\Inventory;
use App\Models\StorageInovice;
use App\Models\Suppliers,id;

class StorageInoviceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StorageInovice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->word,
            'type' => $this->faker->randomElement(["in","out"]),
            'supplier_id' => Suppliers,id::factory(),
            'total' => $this->faker->randomFloat(4, 0, 9999.9999),
            'received' => $this->faker->randomFloat(4, 0, 9999.9999),
            'remaining' => $this->faker->randomFloat(4, 0, 9999.9999),
            'is_finished' => $this->faker->boolean,
            'inventory_id' => Inventory::factory(),
            'created_by' => CreatedBy::factory(),
        ];
    }
}
