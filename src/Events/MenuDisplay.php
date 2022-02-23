<?php

namespace TopSystem\TopAdmin\Events;

use Illuminate\Queue\SerializesModels;
use TopSystem\TopAdmin\Models\Menu;

class MenuDisplay
{
    use SerializesModels;

    public $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;

        // @deprecate
        //
        event('admin.menu.display', $menu);
    }
}
