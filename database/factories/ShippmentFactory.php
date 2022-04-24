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
            'business_referance' => 'business',
            'receiver_name' => $this->faker->name(),
            'receiver_phone' => '99980',
            'address' => 'remal',
            'price' => '445',
            'package_details' => 'no detali',
            'note' => 'notlk',
            'status' => 'delevier',
            'user_id' => '1',
            'city_id' => '2',
            'area_id' => '1',
        ];
    }
}
