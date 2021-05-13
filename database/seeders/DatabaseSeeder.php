<?php

namespace Database\Seeders;

use App\Http\Controllers\ImageSaverController;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        ImageSaverController::DeleteAllDirectory();

        $this->call([
            UserSeeder::class,
            TagSeeder::class,
            PostSeeder::class
        ]);

        foreach (Post::all() as $post){
            $randomNumberArray = range(rand(1,4), rand(5,10));
            $post->Tag()->sync($randomNumberArray);
        }
    }
}
