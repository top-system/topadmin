<?php

use Illuminate\Support\Str;
use TopSystem\TopAdmin\Events\Routing;
use TopSystem\TopAdmin\Events\RoutingAdmin;
use TopSystem\TopAdmin\Events\RoutingAdminAfter;
use TopSystem\TopAdmin\Events\RoutingAfter;
use TopSystem\TopAdmin\Facades\Admin;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| This file is where you may override any of the routes that are included
| with Admin.
|
*/

Route::group(['as' => 'admin.'], function () {
    event(new Routing());

    $namespacePrefix = '\\'.config('admin.controllers.namespace').'\\';

    Route::get('login', ['uses' => $namespacePrefix.'AdminAuthController@login',     'as' => 'login']);
    Route::post('login', ['uses' => $namespacePrefix.'AdminAuthController@postLogin', 'as' => 'postlogin']);

    Route::group(['middleware' => 'admin.user'], function () use ($namespacePrefix) {
        event(new RoutingAdmin());

        // Main Admin and Logout Route
        Route::get('/', ['uses' => $namespacePrefix.'AdminController@index',   'as' => 'dashboard']);
        Route::any('logout', ['uses' => $namespacePrefix.'AdminController@logout',  'as' => 'logout']);
        Route::post('upload', ['uses' => $namespacePrefix.'AdminController@upload',  'as' => 'upload']);

        Route::get('profile', ['uses' => $namespacePrefix.'AdminUserController@profile', 'as' => 'profile']);

        try {
            foreach (Admin::model('DataType')::all() as $dataType) {
                $breadController = $dataType->controller
                    ? Str::start($dataType->controller, '\\')
                    : $namespacePrefix.'AdminBaseController';

                Route::get($dataType->slug.'/order', $breadController.'@order')->name($dataType->slug.'.order');
                Route::post($dataType->slug.'/action', $breadController.'@action')->name($dataType->slug.'.action');
                Route::post($dataType->slug.'/order', $breadController.'@update_order')->name($dataType->slug.'.update_order');
                Route::get($dataType->slug.'/{id}/restore', $breadController.'@restore')->name($dataType->slug.'.restore');
                Route::get($dataType->slug.'/relation', $breadController.'@relation')->name($dataType->slug.'.relation');
                Route::post($dataType->slug.'/remove', $breadController.'@remove_media')->name($dataType->slug.'.media.remove');
                Route::resource($dataType->slug, $breadController, ['parameters' => [$dataType->slug => 'id']]);
            }
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException("Custom routes hasn't been configured because: ".$e->getMessage(), 1);
        } catch (\Exception $e) {
            // do nothing, might just be because table not yet migrated.
        }

        // Menu Routes
        Route::group([
            'as'     => 'menus.',
            'prefix' => 'menus/{menu}',
        ], function () use ($namespacePrefix) {
            Route::get('builder', ['uses' => $namespacePrefix.'AdminMenuController@builder',    'as' => 'builder']);
            Route::post('order', ['uses' => $namespacePrefix.'AdminMenuController@order_item', 'as' => 'order_item']);

            Route::group([
                'as'     => 'item.',
                'prefix' => 'item',
            ], function () use ($namespacePrefix) {
                Route::delete('{id}', ['uses' => $namespacePrefix.'AdminMenuController@delete_menu', 'as' => 'destroy']);
                Route::post('/', ['uses' => $namespacePrefix.'AdminMenuController@add_item',    'as' => 'add']);
                Route::put('/', ['uses' => $namespacePrefix.'AdminMenuController@update_item', 'as' => 'update']);
            });
        });

        // Settings
        Route::group([
            'as'     => 'settings.',
            'prefix' => 'settings',
        ], function () use ($namespacePrefix) {
            Route::get('/', ['uses' => $namespacePrefix.'AdminSettingsController@index',        'as' => 'index']);
            Route::post('/', ['uses' => $namespacePrefix.'AdminSettingsController@store',        'as' => 'store']);
            Route::put('/', ['uses' => $namespacePrefix.'AdminSettingsController@update',       'as' => 'update']);
            Route::delete('{id}', ['uses' => $namespacePrefix.'AdminSettingsController@delete',       'as' => 'delete']);
            Route::get('{id}/move_up', ['uses' => $namespacePrefix.'AdminSettingsController@move_up',      'as' => 'move_up']);
            Route::get('{id}/move_down', ['uses' => $namespacePrefix.'AdminSettingsController@move_down',    'as' => 'move_down']);
            Route::put('{id}/delete_value', ['uses' => $namespacePrefix.'AdminSettingsController@delete_value', 'as' => 'delete_value']);
        });

        // Admin Media
        Route::group([
            'as'     => 'media.',
            'prefix' => 'media',
        ], function () use ($namespacePrefix) {
            Route::get('/', ['uses' => $namespacePrefix.'AdminMediaController@index',              'as' => 'index']);
            Route::post('files', ['uses' => $namespacePrefix.'AdminMediaController@files',              'as' => 'files']);
            Route::post('new_folder', ['uses' => $namespacePrefix.'AdminMediaController@new_folder',         'as' => 'new_folder']);
            Route::post('delete_file_folder', ['uses' => $namespacePrefix.'AdminMediaController@delete', 'as' => 'delete']);
            Route::post('move_file', ['uses' => $namespacePrefix.'AdminMediaController@move',          'as' => 'move']);
            Route::post('rename_file', ['uses' => $namespacePrefix.'AdminMediaController@rename',        'as' => 'rename']);
            Route::post('upload', ['uses' => $namespacePrefix.'AdminMediaController@upload',             'as' => 'upload']);
            Route::post('crop', ['uses' => $namespacePrefix.'AdminMediaController@crop',             'as' => 'crop']);
        });

        // BREAD Routes
        Route::group([
            'as'     => 'bread.',
            'prefix' => 'bread',
        ], function () use ($namespacePrefix) {
            Route::get('/', ['uses' => $namespacePrefix.'AdminBreadController@index',              'as' => 'index']);
            Route::get('{table}/create', ['uses' => $namespacePrefix.'AdminBreadController@create',     'as' => 'create']);
            Route::post('/', ['uses' => $namespacePrefix.'AdminBreadController@store',   'as' => 'store']);
            Route::get('{table}/edit', ['uses' => $namespacePrefix.'AdminBreadController@edit', 'as' => 'edit']);
            Route::put('{id}', ['uses' => $namespacePrefix.'AdminBreadController@update',  'as' => 'update']);
            Route::delete('{id}', ['uses' => $namespacePrefix.'AdminBreadController@destroy',  'as' => 'delete']);
            Route::post('relationship', ['uses' => $namespacePrefix.'AdminBreadController@addRelationship',  'as' => 'relationship']);
            Route::get('delete_relationship/{id}', ['uses' => $namespacePrefix.'AdminBreadController@deleteRelationship',  'as' => 'delete_relationship']);
        });

        // Database Routes
        Route::resource('database', $namespacePrefix.'AdminDatabaseController');

        // Compass Routes
        Route::group([
            'as'     => 'compass.',
            'prefix' => 'compass',
        ], function () use ($namespacePrefix) {
            Route::get('/', ['uses' => $namespacePrefix.'AdminCompassController@index',  'as' => 'index']);
            Route::post('/', ['uses' => $namespacePrefix.'AdminCompassController@index',  'as' => 'post']);
        });

        event(new RoutingAdminAfter());
    });

    //Asset Routes
    Route::get('admin-assets', ['uses' => $namespacePrefix.'AdminController@assets', 'as' => 'admin_assets']);

    event(new RoutingAfter());
});