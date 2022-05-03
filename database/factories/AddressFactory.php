<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
	    'firstname' => "Jedrzej",
	    'lastname' => "Dawidek",
	    'house_number' => "12A",
	    'street_name' => "Al Paca",
	    'city' => "Warsaw",
	    'country' => "Poland",
	    'postal_code' => "12-1212"
        ];
    }
}
