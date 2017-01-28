<?php

namespace Humweb\Settings;

use Humweb\Modules\ModuleBaseProvider;
use Humweb\Settings\Encoders\JsonEncoder;
use Humweb\Settings\Storage\DbStorage;

class ServiceProvider extends ModuleBaseProvider
{
    protected $permissions = [

        // Settings
        'settings.edit' => [
            'name'        => 'Edit Settings',
            'description' => 'Edit settings.',
        ],
    ];

    protected $moduleMeta = [
        'name'    => 'Settings System',
        'slug'    => 'settings',
        'version' => '',
        'author'  => '',
        'email'   => '',
        'website' => '',
    ];


    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->app['modules']->put('settings', $this);
        $this->loadViews();
    }


    public function register()
    {
        $this->app->singleton('settings.schema.manager', function ($app) {
            return new SchemaManager();
        });

        $this->app->singleton('settings.encoder', function ($app) {
            return new JsonEncoder();
        });

        $this->app->singleton('settings.storage', function ($app) {
            return new DbStorage();
        });

        $this->app->singleton('settings', function ($app) {
            return new Setting($app['settings.storage'], $app['settings.encoder']);
        });
    }



    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }
}
