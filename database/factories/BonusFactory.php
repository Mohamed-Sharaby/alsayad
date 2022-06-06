<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Bonus;

class BonusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bonus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'admin_id' => Admin::factory(),
            'date' => $this->faker->date(),
            'type' => $this->faker->randomElement(["bonus","deduction"]),
            'amount' => $this->faker->randomFloat(4, 0, 9999.9999),
            'notes' => $this->faker->text,
        ];
    }
}
