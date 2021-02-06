<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           
                'PatientName'=>$this->faker->name,
                'Gender'=>$this->faker->randomElement(['female','male']),
                'Category'=>$this->faker->randomElement(['asymptomatic','symptomatic']),
                'District'=>$this->faker->state,
                'Enrollment_Date'=>$this->faker->dateTimeBetween('-1 year')
        ];
    }
}
