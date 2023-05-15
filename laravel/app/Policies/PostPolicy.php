<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use App\Models\AdminUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\AdminUser  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(AdminUser $user)
    {
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\AdminUser  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(AdminUser $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\AdminUser  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(AdminUser $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\AdminUser  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(AdminUser $user, Post $post)
    {
		return $user->roles->containsStrict('id', 1);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\AdminUser  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(AdminUser $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\AdminUser  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(AdminUser $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\AdminUser  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(AdminUser $user, Post $post)
    {
        //
    }
}
