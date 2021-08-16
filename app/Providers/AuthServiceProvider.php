<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Member' => 'App\Policies\MemberPolicy',
        // 'App\Models\Project' => 'App\Policies\ProjectPolicy',
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        Gate::before(function ($user, $ability) {//Check Full permission
            if($user->isSuperAdmin()) {
                return true;
            }
        });
        foreach(Permission::all() as $permission){//Check per permission
            Gate::define($permission->slug,function($user) use ($permission){
                return $user->hasPermission($permission);
            });
        }
    }
}
