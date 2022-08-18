<?php

namespace Database\Factories;

use App\Models\Palavra;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PalavraFactory extends Factory
{
    protected $model = Palavra::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'palavra' => $this->faker->word,
            'status' => 1
        ];
    }
}
