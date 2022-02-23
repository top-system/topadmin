<?php

namespace TopSystem\TopAdmin\Listeners;

use TopSystem\TopAdmin\Events\BreadDeleted;
use TopSystem\TopAdmin\Facades\Admin;

class DeleteBreadMenuItem
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Delete a MenuItem for a given BREAD.
     *
     * @param BreadDeleted $bread
     *
     * @return void
     */
    public function handle(BreadDeleted $bread)
    {
        if (config('admin.bread.add_menu_item')) {
            $menuItem = Admin::model('MenuItem')->where('route', 'admin.'.$bread->dataType->slug.'.index');

            if ($menuItem->exists()) {
                $menuItem->delete();
            }
        }
    }
}
