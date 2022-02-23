<?php

namespace TopSystem\TopAdmin\Events;

use Illuminate\Queue\SerializesModels;
use TopSystem\TopAdmin\Models\Setting;

class SettingUpdated
{
    use SerializesModels;

    public $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }
}
