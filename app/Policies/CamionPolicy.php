<?php

namespace App\Policies;

use App\User;
use App\Modelos\Camion;
use Illuminate\Auth\Access\HandlesAuthorization;

class CamionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the camion.
     *
     * @param  \App\User  $user
     * @param  \App\Modelos\Camion  $camion
     * @return mixed
     */
    public function view(User $user, Camion $camion)
    {
        return $user->id === ;
    }

    /**
     * Determine whether the user can create camions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the camion.
     *
     * @param  \App\User  $user
     * @param  \App\Modelos\Camion  $camion
     * @return mixed
     */
    public function update(User $user, Camion $camion)
    {
        //
    }

    /**
     * Determine whether the user can delete the camion.
     *
     * @param  \App\User  $user
     * @param  \App\Modelos\Camion  $camion
     * @return mixed
     */
    public function delete(User $user, Camion $camion)
    {
        //
    }
}
