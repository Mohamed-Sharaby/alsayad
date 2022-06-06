<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\StorageInvoice;
use App\Models\StorageInvoiceItem;

class StorageInvoiceItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StorageInvoiceItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'storage_invoice_id' => StorageInvoice::factory(),
            'product_id' => Product::factory(),
            'buying_price' => $this->faker->randomFloat(4, 0, 9999.9999),
            'quantity' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
