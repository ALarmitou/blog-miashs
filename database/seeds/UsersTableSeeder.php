<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)->create()->each(function ($user) {
            $post = factory(App\Post::class)->create();
            $post->comments()->save(factory(App\Comment::class)->create());
            $user->posts()->save($post);
        });

    }
}
