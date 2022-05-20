<?php

namespace Database\Factories;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Quiz::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'course' => $this->faker->word,
        'userid' => $this->faker->numberBetween(1,10),
        'name' => $this->faker->word,
        'intro' => $this->faker->text,
        'timeopen' => $this->faker->date('Y-m-d H:i:s'),
        'timeclose' => $this->faker->date('Y-m-d H:i:s'),
        'timelimit' => $this->faker->word,
        'canredoquestions' => $this->faker->word,
        'attempts' => $this->faker->randomDigitNotNull,
        'questionsperpage' => $this->faker->word,
        'shuffleanswers' => $this->faker->word,
        'grade' => $this->faker->word,
        'password' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
