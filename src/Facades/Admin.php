<?php

namespace TopSystem\TopAdmin\Facades;

use Illuminate\Support\Facades\Facade;

class Admin extends Facade
{

    /**
     * Get the registered name of the component.
     * @method static string image($file, $default = '')
     * @method static $this useModel($name, $object)
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'admin';
    }
}