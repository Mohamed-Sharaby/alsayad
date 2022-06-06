<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Inventory;
use App\Models\StorageInvoice;
use App\Models\Supplier;

class StorageInvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StorageInvoice::class;

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
            'supplier_id' => Supplier::factory(),
            'total' => $this->faker->randomFloat(4, 0, 9999.9999),
            'received' => $this->faker->randomFloat(4, 0, 9999.9999),
            'remaining' => $this->faker->randomFloat(4, 0, 9999.9999),
            'is_finished' => $this->faker->boolean,
            'inventory_id' => Inventory::factory(),
            'created_by' => Admin::factory()->create()->created_by,
        ];
    }
}
