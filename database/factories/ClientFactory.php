<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'region'=>fake()->city(),
            'orientr'=>fake()->address(),
            'phone'=>fake()->phoneNumber(),
            'agent_id'=>rand(1,100),
            'debt'=>rand(1000,100000)
        ];
    }
}
