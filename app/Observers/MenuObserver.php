<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use App\Models\Menu;

class MenuObserver
{
    /**
     * Handle the Menu "created" event.
     *
     * @param  \App\Models\Menu  $Menu
     * @return void
     */

    public $afterCommit = true;

    public function creating(Menu $Menu)
    {
        $Menu->type             = 'main';
        $Menu->is_active        = true;
        $Menu->created_by       = (Auth::user()) ? Auth::user()->id : null;
    }

     /**
      * Handle the Menu "updated" event.
      *
      * @param  \App\Models\Menu  $Menu
      * @return void
      */
    public function updating(Menu $Menu)
    {
        $Menu->updated_by = (Auth::user()) ? Auth::user()->id : null;
    }

     /**
      * Handle the Menu "deleted" event.
      *
      * @param  \App\Models\Menu  $Menu
      * @return void
      */
    public function deleted(Menu $Menu)
    {
        //
    }

     /**
      * Handle the Menu "restored" event.
      *
      * @param  \App\Models\Menu  $Menu
      * @return void
      */
    public function restored(Menu $Menu)
    {
        //
    }

     /**
      * Handle the Menu "force deleted" event.
      *
      * @param  \App\Models\Menu  $Menu
      * @return void
      */
    public function forceDeleted(Menu $Menu)
    {
        //
    }
}
