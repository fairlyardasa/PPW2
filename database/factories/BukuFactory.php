<?php

namespace Database\Factories;

use App\Models\Buku;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buku>
 */
class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * 
     * 
     */

    // protected $model = Buku::class;

    public function definition()
    {


        return [
            'judul' => $this->faker->words(3, true),
            'penulis' => $this->faker->name(),
            'harga' => $this->faker->numberBetween($min = 15000, $max = 60000),
            'tgl_terbit' => $this->faker->date($format = 'Y-m-d')

        ];
    }
}