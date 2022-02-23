<?php

namespace TopSystem\TopAdmin\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TopSystem\TopAdmin\Facades\Admin;

class UserDimmer extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = Admin::model('User')->count();
        $string = trans_choice('admin::dimmer.user', $count);

        return view('admin::dimmer', array_merge($this->config, [
            'icon'   => 'admin-group',
            'title'  => "{$count} {$string}",
            'text'   => __('admin::dimmer.user_text', ['count' => $count, 'string' => Str::lower($string)]),
            'button' => [
                'text' => __('admin::dimmer.user_link_text'),
                'link' => route('admin.users.index'),
            ],
            'image' => admin_asset('images/widget-backgrounds/01.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', Admin::model('User'));
    }
}
