<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'service_name' => Str::random(10) ,
            'date_time' => now() ,
            'method' => Str::random(5) ,
            'path' => Str::random(10) ,
            'protocol' => Str::random(10) ,
            'status_code' => $this->faker->numberBetween(200 , 500) ,
            'created_at' => now()
        ];
    }
}
