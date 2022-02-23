<?php

namespace TopSystem\TopAdmin\Models;

use Illuminate\Database\Eloquent\Model;
use TopSystem\TopAdmin\Events\SettingUpdated;

class Setting extends Model
{
    protected $table = 'settings';

    protected $guarded = [];

    public $timestamps = false;

    protected $dispatchesEvents = [
        'updating' => SettingUpdated::class,
    ];
}
