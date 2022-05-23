<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'questiontext' => $this->faker->text,
        'questiontextformat' => $this->faker->word,
        'generalfeedback' => $this->faker->text,
        'generalfeedbackformat' => $this->faker->word,
        'defaultmark' => $this->faker->word,
        'penalty' => $this->faker->word,
        'qtype' => $this->faker->word,
        'length' => $this->faker->word,
        'created_by' => $this->faker->word,
        'modified_by' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
