<?php

namespace App\Providers;

use App\Models\AdminUser;
use App\Models\Post;
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
       Post::class => PostPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('delete-post', function(AdminUser $user, Post $post){
				return $user->roles->containsStrict('id', 2);
		  });

        Gate::define('update-post', function(AdminUser $user, Post $post){
				return $user->roles->containsStrict('id', 2);
		  }); 

		//  Gate::before(function(AdminUser $user){
		//		return $user->roles->containsStrict('id', 2);
	 	//	});
    }
}
