<?php

namespace Database\Factories;

use App\Http\Controllers\ImageSaverController;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $imageSaver = new ImageSaverController();
        return [
            'user_id' => 1,
            'category_id' => rand(1,5),
            'title' => $this->faker->sentence,
            'caption' => $this->faker->text(150),
            'url' => $imageSaver->loadImage("https://loremflickr.com/2500/1920/sunrise,computer")->saveAllSizes()
        ];
    }
}
