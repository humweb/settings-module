<?php


    //GET

    Route::get('admin/settings/{module}', [
        'as' => 'get.admin.settings.index',
        'uses' => 'AdminSettingsController@getSystem',
        'middleware' => 'allow.only',
        'permissions' => ['settings.edit'],
    ]);

    Route::post('admin/settings/save/{module}', [
        'as' => 'post.admin.settings.save',
        'uses' => 'AdminSettingsController@postSave',
        'middleware' => 'allow.only',
        'permissions' => ['settings.edit'],
    ]);
