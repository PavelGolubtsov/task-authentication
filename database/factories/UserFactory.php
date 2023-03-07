<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'login' => $this->faker->unique()->firstName(),
            'email' => $this->faker->unique()->email(),
            'email_verified_at' => now(),
            // 'password' => Hash::make('password'),
            'password' => '$2y$10$tfqnNVzKrvjUuR7UJ19qte61gm1RM6UTDgTBiwv/ntefPQNvSfkHy',
            'remember_token' => Str::random(16),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
