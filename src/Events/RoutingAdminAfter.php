<?php

namespace TopSystem\TopAdmin\Events;

use Illuminate\Queue\SerializesModels;

class RoutingAdminAfter
{
    use SerializesModels;

    public $router;

    public function __construct()
    {
        $this->router = app('router');

        // @deprecate
        //
        event('admin.admin.routing.after', $this->router);
    }
}
