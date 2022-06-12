<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
   /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;
   
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'release_date' => $this->faker->date,
            'url' => 'https://www.youtube.com/watch?v=bLPCVGigTrw&ab_channel=MotivationalStories',
            'user_id' => $this->faker->numberBetween($min = 2, $max = 50)
        ];
    }
}
