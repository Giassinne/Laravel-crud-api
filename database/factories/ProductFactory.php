<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true), // Ex : "Wireless Bluetooth Speaker"
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 5, 1000),
            'quantity' => $this->faker->numberBetween(0, 100),
        ];
    }

}
