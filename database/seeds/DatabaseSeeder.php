<?php

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
        factory(App\User::class, 50)->create()->each(function ($user) {
            $video = $user->videos()->save(factory(App\Video::class)->make());
            $video->metadata()->save(factory(App\VideoMetadata::class)->make());
        });


        // $this->call(UsersTableSeeder::class);
        // $this->call(VideosTableSeeder::class);
    }
}
