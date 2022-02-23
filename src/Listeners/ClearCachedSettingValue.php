<?php

namespace TopSystem\TopAdmin\Listeners;

use Cache;
use TopSystem\TopAdmin\Events\SettingUpdated;

class ClearCachedSettingValue
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
     * handle.
     *
     * @param SettingUpdated $event
     *
     * @return void
     */
    public function handle(SettingUpdated $event)
    {
        if (config('admin.settings.cache', false) === true) {
            Cache::tags('settings')->forget($event->setting->key);
        }
    }
}
