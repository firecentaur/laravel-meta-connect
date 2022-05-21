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
            'parent' => $this->faker->word,
        'name' => $this->faker->word,
        'questiontext' => $this->faker->text,
        'questiontextformat' => $this->faker->word,
        'generalfeedback' => $this->faker->text,
        'generalfeedbackformat' => $this->faker->word,
        'defaultmark' => $this->faker->word,
        'penalty' => $this->faker->word,
        'qtype' => $this->faker->word,
        'length' => $this->faker->word,
        'stamp' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'createdby' => $this->faker->word,
        'modifiedby' => $this->faker->word
        ];
    }
}
