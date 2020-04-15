<?php

namespace App\Providers;

use App\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        Passport::routes();
        if(Schema::hasTable('permissions')) {
            $permissions = Permission::all();
            $scopes = array();
            foreach ($permissions as $permission) {
                $scopes[$permission->slug] = $permission->name;
            }
            Passport::tokensCan($scopes);
        }
    }
}
