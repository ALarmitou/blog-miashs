<?php

use App\Permission;
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
        });

        $admin = Role::where('slug','admin')->first();
        $commentManager = Role::where('slug', 'comment-manager')->first();
        $user = Role::where('slug', 'user')->first();
        $managePosts = Permission::where('slug','manage-posts')->first();
        $manageUsers = Permission::where('slug','manage-users')->first();
        $manageRoles = Permission::where('slug','manage-roles')->first();
        $manageComments = Permission::where('slug','manage-comments')->first();

        $adminUser = new User();
        $adminUser->name = 'Admin admin';
        $adminUser->email = 'admin@admin.fr';
        $adminUser->password = bcrypt('adminadmin');
        $adminUser->save();
        $adminUser->roles()->attach($admin);
        $adminUser->permissions()->attach($managePosts);
        $adminUser->permissions()->attach($manageUsers);
        $adminUser->permissions()->attach($manageRoles);
        $adminUser->permissions()->attach($manageComments);


        $commentManagerUser = new User();
        $commentManagerUser->name = 'Comment Manager';
        $commentManagerUser->email = 'commment@comment.com';
        $commentManagerUser->password = bcrypt('commentcomment');
        $commentManagerUser->save();
        $commentManagerUser->roles()->attach($commentManager);
        $commentManagerUser->permissions()->attach($manageComments);

        $commentManagerUser = new User();
        $commentManagerUser->name = 'User';
        $commentManagerUser->email = 'user@user.com';
        $commentManagerUser->password = bcrypt('useruser');
        $commentManagerUser->save();
        $commentManagerUser->roles()->attach($user);

    }
}
