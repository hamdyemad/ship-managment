<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shippment>
 */
class ShippmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'shippment_type' => 'forward',
            'business_referance' => $this->faker->name(),
            'receiver_name' => $this->faker->name(),
            'receiver_phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'price' => $this->faker->randomNumber(2),
            'barcode' => $this->faker->randomNumber(6),
            'package_details' => 'no detali',
            'note' => 'notlk',
            'status' => 'created',
            'user_id' => '1',
            'city_id' => '2',
            'area_id' => '1',
        ];
    }
}
