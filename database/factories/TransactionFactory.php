<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Transaction;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_by' => Admin::factory()->create()->created_by,
            'type' => $this->faker->randomElement(["in","out"]),
            'amount' => $this->faker->randomFloat(4, 0, 9999.9999),
            'is_points' => $this->faker->boolean,
        ];
    }
}
