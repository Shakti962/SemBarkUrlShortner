<?php

namespace Database\Factories;

use App\Models\Url;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Url>
 */
class UrlFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dateTime = fake()->dateTimeBetween('-30 days', 'now');
        return [
            'original_url' => $this->faker->url(),
            'short_code' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'created_at' => $dateTime,
            'updated_at' => $dateTime
        ];
    }
}
