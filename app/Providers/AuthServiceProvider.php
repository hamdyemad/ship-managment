<?php

namespace App\Providers;
use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
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

        $permissions = Permission::all();
        $hasPermission = false;

        foreach ($permissions as $perm) {
            Gate::define($perm['value'],function($user) use($perm, $hasPermission) {
                if($user->type == 'admin') {
                    $hasPermission = true;
                } else {
                    foreach ($user->roles as $role) {
                        if($role->permissions->contains('value', $perm['value'])) {
                            $hasPermission = true;
                        }
                    }
                }
                return $hasPermission;
            });
        }
    }
}
