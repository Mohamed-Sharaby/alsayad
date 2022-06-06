<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Supplier;

class SupplierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'area' => $this->faker->word(),
            'address' => $this->faker->word(),
            'phone' => $this->faker->phoneNumber(),
            'notes' => $this->faker->text(),
            'is_active' => $this->faker->boolean(),
            'created_by' => 1,
        ];
    }
}
