<?php

namespace App\Policies;

use App\Booking;
use App\Apartment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class apartmentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Apartment $apartment)
    {

        return $user->id == $apartment->user_id || $user->hasRole('administrator');

    }

    public function review($user, $id)
    {

        return $user->reviews()->where('booking_id',$id)->exists();

    }

}
