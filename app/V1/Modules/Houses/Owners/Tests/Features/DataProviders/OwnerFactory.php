<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Owners\Tests\Features\DataProviders;

use App\V1\Modules\Houses\Owners\Domain\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;

class OwnerFactory extends Factory
{
    protected $model = Owner::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
