<?php

namespace Database\Factories;

use App\Models\Hospital;
use Illuminate\Database\Eloquent\Factories\Factory;

class HospitalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hospital::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category'=>$this->faker->randomElement(['National','Regional','General',]),
                'District'=>$this->faker->state,
                'hospitalName'=>$this->faker->state."Hospital",
                'number_of_officers'=>$this->faker->numberBetween($min=9,$max=100)
        ];
    }
}
