<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sender_id' => 1,
	    'sender_address_id' => 1,
	    'recipient_id' => 1,
	    'recipient_address_id' => 1,
	    'email_recipient' => "sa@example.com",
	    'emailSender' => "sa@example.com",
	    'emailRecipient' => "admin@example.com",
	    'status' => "signed up"
        ];
    }
}
