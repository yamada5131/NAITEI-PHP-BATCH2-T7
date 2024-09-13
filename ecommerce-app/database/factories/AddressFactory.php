<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Factory<Address>
 */
class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Model>
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address_line1' => fake()->streetAddress,
            'address_line2' => fake()->secondaryAddress,
            'city' => fake()->city,
            'state/province' => fake()->state,
            'postal_code' => fake()->postcode,
            'country_id' => Country::factory(),
            'is_default' => false,
        ];
    }
}
