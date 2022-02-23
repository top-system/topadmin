<?php

namespace TopSystem\TopAdmin\Policies;

use TopSystem\TopAdmin\Contracts\User;
use TopSystem\TopAdmin\Facades\Admin;

class MenuItemPolicy extends BasePolicy
{
    protected static $datatypes = null;
    protected static $permissions = null;

    /**
     * Check if user has an associated permission.
     *
     * @param User   $user
     * @param object $model
     * @param string $action
     *
     * @return bool
     */
    protected function checkPermission(User $user, $model, $action)
    {
        if (self::$permissions == null) {
            self::$permissions = Admin::model('Permission')->all();
        }

        if (self::$datatypes == null) {
            self::$datatypes = Admin::model('DataType')::all()->keyBy('slug');
        }

        $regex = str_replace('/', '\/', preg_quote(route('admin.dashboard')));
        $slug = preg_replace('/'.$regex.'/', '', $model->link(true));
        $slug = str_replace('/', '', $slug);

        if ($str = self::$datatypes->get($slug)) {
            $slug = $str->name;
        }

        if ($slug == '') {
            $slug = 'admin';
        } elseif ($slug == 'compass' && !\App::environment('local') && !config('admin.compass_in_production', false)) {
            return false;
        }

        if (empty($action)) {
            $action = 'browse';
        }

        // If permission doesn't exist, we can't check it!
        if (!self::$permissions->contains('key', $action.'_'.$slug)) {
            return true;
        }

        return $user->hasPermission($action.'_'.$slug);
    }
}
