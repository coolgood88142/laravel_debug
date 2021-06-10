<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $factory->define(App\Post::class, function (Faker $faker) {
            return [
                'user_id' => function () {
                    return factory(App\User::class)->create()->id;
                },
                'title' => $faker->sentence,
                'body' => $faker->paragraph
            ];
        });
    }
}
