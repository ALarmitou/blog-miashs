<?php

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
        $admin->name = "Admin";
        $admin->slug = "admin";
        $admin->save();
        $commentManager = new Role();
        $commentManager->name = "Comment manager";
        $commentManager->slug = "comment-manager";
        $commentManager->save();
        $user = new Role();
        $user->name = "User";
        $user->slug = "user";
        $user->save();

    }
}
