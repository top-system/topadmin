<?php

namespace TopSystem\TopAdmin\Events;

use Illuminate\Queue\SerializesModels;

class RoutingAfter
{
    use SerializesModels;

    public $router;

    public function __construct()
    {
        $this->router = app('router');

        // @deprecate
        //
        event('admin.routing.after', $this->router);
    }
}
