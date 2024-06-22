<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserObserver
{

    // retrieved        : after a record has been retrieved.
    // creating         : before a record has been created.
    // created          : after a record has been created.
    // updating         : before a record is updated.
    // updated          : after a record has been updated.
    // saving           : before a record is saved (either created or updated).
    // saved            : after a record has been saved (either created or updated).
    // deleting         : before a record is deleted or soft-deleted.
    // deleted          : after a record has been deleted or soft-deleted.
    // restoring        : before a soft-deleted record is going to be restored.
    // restored         : after a soft-deleted record has been restored.

    public $afterCommit = true;

    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        // $user->password         = bcrypt(12345678);
        $user->is_confirmed     = true;
        $user->is_active        = true;
        $user->created_by       = (Auth::user()) ? Auth::user()->id : null;
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updating(User $user)
    {
        $user->updated_by = (Auth::user()) ? Auth::user()->id : null;
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
