<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'content' => $this->faker->paragraph(2),
            'rating' => $this->faker->numberBetween(3, 5),
            'image' => null, // atau gunakan dummy path jika perlu
            'is_active' => $this->faker->boolean(80),
        ];
    }
}
