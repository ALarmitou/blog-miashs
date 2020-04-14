<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = "Administrator";
        $admin->slug = "admin";
        $admin->save();

        $moderator = new Role();
        $moderator->name = "Moderator";
        $moderator->slug = "moderator";
        $moderator->save();

        $user = new Role();
        $user->name = "User";
        $user->slug = "user";
        $user->save();

        $createPosts = Permission::where('slug','create-posts')->first();
        $managePosts = Permission::where('slug','manage-posts')->first();
        $manageUsers = Permission::where('slug','manage-users')->first();
        $manageRoles = Permission::where('slug','manage-roles')->first();
        $manageComments = Permission::where('slug','manage-comments')->first();

        $admin->permissions()->attach($managePosts);
        $admin->permissions()->attach($manageUsers);
        $admin->permissions()->attach($manageRoles);
        $admin->permissions()->attach($createPosts);
        $admin->permissions()->attach($manageComments);
        $moderator->permissions()->attach($createPosts);
        $moderator->permissions()->attach($manageComments);
        $user->permissions()->attach($createPosts);

    }
}
