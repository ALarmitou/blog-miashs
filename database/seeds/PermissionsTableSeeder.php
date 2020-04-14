<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manageUser = new Permission();
        $manageUser->name = 'Manage users';
        $manageUser->slug = 'manage-users';
        $manageUser->save();

        $createTasks = new Permission();
        $createTasks->name = 'Manage posts';
        $createTasks->slug = 'manage-posts';
        $createTasks->save();

        $createTasks = new Permission();
        $createTasks->name = 'Create posts';
        $createTasks->slug = 'create-posts';
        $createTasks->save();

        $createTasks = new Permission();
        $createTasks->name = 'Manage comments';
        $createTasks->slug = 'manage-comments';
        $createTasks->save();

        $createTasks = new Permission();
        $createTasks->name = 'Manage roles';
        $createTasks->slug = 'manage-roles';
        $createTasks->save();


    }

}
