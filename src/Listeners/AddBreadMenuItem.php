<?php

namespace TopSystem\TopAdmin\Listeners;

use TopSystem\TopAdmin\Events\BreadAdded;
use TopSystem\TopAdmin\Facades\Admin;

class AddBreadMenuItem
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
     * Create a MenuItem for a given BREAD.
     *
     * @param BreadAdded $event
     *
     * @return void
     */
    public function handle(BreadAdded $bread)
    {
        if (config('admin.bread.add_menu_item') && file_exists(base_path('routes/web.php'))) {
            $menu = Admin::model('Menu')->where('name', config('admin.bread.default_menu'))->firstOrFail();

            $menuItem = Admin::model('MenuItem')->firstOrNew([
                'menu_id' => $menu->id,
                'title'   => $bread->dataType->getTranslatedAttribute('display_name_plural'),
                'url'     => '',
                'route'   => 'admin.'.$bread->dataType->slug.'.index',
            ]);

            $order = Admin::model('MenuItem')->highestOrderMenuItem();

            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => $bread->dataType->icon,
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => $order,
                ])->save();
            }
        }
    }
}
