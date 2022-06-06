<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Sallary;

class SallaryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sallary::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'admin_id' => Admin::factory(),
            'role' => $this->faker->word,
            'main_salary' => $this->faker->numberBetween(-10000, 10000),
            'increases' => $this->faker->numberBetween(-10000, 10000),
            'deductions' => $this->faker->numberBetween(-10000, 10000),
            'notes' => $this->faker->text,
            'status' => $this->faker->boolean,
        ];
    }
}
