<?php

namespace Humweb\Settings\Controllers;

use App\Http\Controllers\AdminController;
use Humweb\Settings\Facades\Settings;
use Humweb\Settings\Facades\SchemaManager as SettingsSchema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminSettingsController extends AdminController
{
    protected $data;
    protected $provider;
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->viewShare('title', 'Settings Management');
    }

    public function getSystem($module = 'site')
    {
        $moduleName = ucfirst($module);

        $this->viewShare('title', 'Settings - '.$moduleName);
        $this->crumb('Settings')->crumb($moduleName);

        $this->data['module'] = $module;
        $this->data['settings'] = Settings::get($module.'.*');
        $this->data['settingsSchema'] = SettingsSchema::get($module, $this->data['settings']);

        return $this->setContent('settings::admin.index', $this->data);
    }

    public function postSave(Request $request, $module = 'site')
    {
        $schema = SettingsSchema::get($module);
        $settings = $request->get('settings');

        //@todo invalidate/expire cache

        foreach ($settings as $key => $val) {
            if ($schema->isAcceptableKey($key)) {
                Settings::set($key, $val);
            }
        }

        return redirect()->back()->with('success', 'Settings have been saved.');
    }
}