<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Sale;

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->word,
            'date' => $this->faker->date(),
            'client_id' => Client::factory(),
            'total' => $this->faker->randomFloat(4, 0, 9999.9999),
            'received' => $this->faker->randomFloat(4, 0, 9999.9999),
            'remaining' => $this->faker->randomFloat(4, 0, 9999.9999),
            'is_finished' => $this->faker->boolean,
            'created_by' => Admin::factory()->create()->created_by,
        ];
    }
}
