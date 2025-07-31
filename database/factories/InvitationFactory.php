<?php

namespace Database\Factories;

use App\Models\Invitation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invitation>
 */
class InvitationFactory extends Factory
{
    protected $model = Invitation::class;

    public function definition()
    {
        $name = $this->faker->name;
        return [
            'name' => $name,
            // slug & code are auto-set by your model boot() hook
        ];
    }
}
