<?php

namespace App\Policies;


use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the item.
     *
     * @param  \App\User  $user
     * @param  \App\Item  $item
     * @return mixed
     */
    public function view(User $user, Item $item)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can create items.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the item.
     *
     * @param  \App\User  $user
     * @param  \App\Item  $item
     * @return mixed
     */

    public function update(User $user, Item $item)
    {
        //
    }

    /**
     * Determine whether the user can delete the item.
     *
     * @param  \App\User  $user
     * @param  \App\Item  $item
     * @return mixed
     */
    public function delete(User $user, Item $item)
    {
        //
    }
}
