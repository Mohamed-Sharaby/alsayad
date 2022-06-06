<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Expense;
use App\Models\ExpenseItem;

class ExpenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date(),
            'expense_item_id' => ExpenseItem::factory(),
            'price' => $this->faker->randomFloat(4, 0, 9999.9999),
            'created_by' => Admin::factory()->create()->created_by,
        ];
    }
}
