<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = Carbon::now()->format('Ym');
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'employee_number' => $date . rand(1000, 9999),
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => null,
            'account_status' => true
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole('User');
        });
    }
}
