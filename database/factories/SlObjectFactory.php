<?php

namespace Database\Factories;

use App\Models\SlObject;
use Illuminate\Database\Eloquent\Factories\Factory;

class SlObjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SlObject::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'UUID' => $this->faker->word,
        'owner' => $this->faker->word,
        'name' => $this->faker->word,
        'description' => $this->faker->word,
        'group' => $this->faker->word,
        'type' => $this->faker->word,
        'slurl' => $this->faker->word,
        'active' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->randomDigitNotNull
        ];
    }
}
