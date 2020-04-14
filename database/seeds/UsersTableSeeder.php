<?php

use App\Role;
use App\User;
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
            $userRole = Role::where('slug', 'user')->first();
            $user->roles()->attach($userRole);
        });

        $admin = Role::where('slug','admin')->first();
        $moderator = Role::where('slug', 'moderator')->first();

        $adminUser = new User();
        $adminUser->name = 'Admin admin';
        $adminUser->email = 'admin@admin.fr';
        $adminUser->password = bcrypt('adminadmin');
        $adminUser->save();
        $adminUser->roles()->attach($admin);


        $moderatorUser = new User();
        $moderatorUser->name = 'Moderator';
        $moderatorUser->email = 'commment@comment.com';
        $moderatorUser->password = bcrypt('commentcomment');
        $moderatorUser->save();
        $moderatorUser->roles()->attach($moderator);

    }
}
