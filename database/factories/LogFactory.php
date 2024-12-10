<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Log>
 */
class LogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=> str()->random(6),
            'user_name'=> fake()->name(),
            'user_in' => Carbon::now()->subMinutes(10),
            'user_out' => Carbon::now()
            //
        ];
    }
}
