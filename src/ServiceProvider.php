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
        $this->loadLang();
        $this->loadViews();
    }


    public function register()
    {
        require __DIR__.'/routes.php';

        $this->app->singleton('settings.schema.manager', function ($app) {
            $manager = new SchemaManager();
            $manager->register('site', 'Humweb\Settings\SiteSettingsSchema');

            return $manager;
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


    public function getAdminMenu()
    {
        return [
            'Settings' => [
                [
                    'label' => 'Site',
                    'url'   => '/admin/settings/site',
                    'icon'  => '<i class="fa fa-home" ></i>',
                ],
            ],
        ];
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
