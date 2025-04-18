<?php
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'table_id' => $this->faker->numberBetween(1, 10),
            'customer_id' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'total_price' => $this->faker->randomFloat(2, 100000, 1000000),
            'note' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'checked_in', 'completed', 'cancelled']),
            'reservation_date' => $this->faker->date,
            'reservation_time' => $this->faker->time,
            'guests' => $this->faker->numberBetween(1, 10),
        ];
    }
}
