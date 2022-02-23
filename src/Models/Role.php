<?php

namespace TopSystem\TopAdmin\Models;

use Illuminate\Database\Eloquent\Model;
use TopSystem\TopAdmin\Facades\Admin;

class Role extends Model
{
    protected $guarded = [];

    public function users()
    {
        $userModel = Admin::modelClass('User');

        return $this->belongsToMany($userModel, 'user_roles')
                    ->select(app($userModel)->getTable().'.*')
                    ->union($this->hasMany($userModel))->getQuery();
    }

    public function permissions()
    {
        return $this->belongsToMany(Admin::modelClass('Permission'));
    }
}
