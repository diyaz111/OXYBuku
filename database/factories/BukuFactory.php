<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'judul' => $this->faker->sentence(5),
            'user_id' => User::all()->random()->id,
            'deskripsi'  => $this->faker->sentence(100),
        ];
    }
}
