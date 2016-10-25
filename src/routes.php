<?php

Route::group(['middleware' => 'auth'], function () {

    Route::get('admin/settings/{module}', [
        'as'         => 'get.admin.settings.index',
        'uses'       => 'AdminSettingsController@getSystem',
        'middleware' => 'allow.only:settings.edit'
    ]);

    Route::post('admin/settings/save/{module}', [
        'as'         => 'post.admin.settings.save',
        'uses'       => 'AdminSettingsController@postSave',
//        'middleware' => 'allow.only:settings.edit'
    ]);
});
