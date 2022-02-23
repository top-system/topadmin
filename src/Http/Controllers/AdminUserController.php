<?php

namespace TopSystem\TopAdmin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TopSystem\TopAdmin\Facades\Admin;

class AdminUserController extends AdminBaseController
{
    public function profile(Request $request)
    {
        $route = '';
        $dataType = Admin::model('DataType')->where('model_name', Auth::guard(app('AdminGuard'))->getProvider()->getModel())->first();
        if (!$dataType && app('AdminGuard') == 'web') {
            $route = route('admin.users.edit', Auth::user()->getKey());
        } elseif ($dataType) {
            $route = route('admin.'.$dataType->slug.'.edit', Auth::user()->getKey());
        }

        return Admin::view('admin::profile', compact('route'));
    }

    // POST BR(E)AD
    public function update(Request $request, $id)
    {
        if (Auth::user()->getKey() == $id) {
            $request->merge([
                'role_id'                              => Auth::user()->role_id,
                'user_belongstomany_role_relationship' => Auth::user()->roles->pluck('id')->toArray(),
            ]);
        }

        return parent::update($request, $id);
    }
}
