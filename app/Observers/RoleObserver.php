<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class RoleObserver
{
    /**
     * Handle the Role "created" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */

    public $afterCommit = true;

    public function creating(Role $role)
    {
        $role->is_active        = true;
        $role->created_by       = (Auth::user()) ? Auth::user()->id : null;
    }

    /**
     * Handle the Role "updated" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function updating(Role $role)
    {
        $role->updated_by = (Auth::user()) ? Auth::user()->id : null;
    }

    /**
     * Handle the Role "deleted" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function deleted(Role $role)
    {
        //
    }

    /**
     * Handle the Role "restored" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function restored(Role $role)
    {
        //
    }

    /**
     * Handle the Role "force deleted" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function forceDeleted(Role $role)
    {
        //
    }
}
