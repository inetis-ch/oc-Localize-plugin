<?php namespace Inetis\Localize;

use Backend;
use System\Classes\PluginBase;

/**
 * Localize Plugin Information File
 */
class Plugin extends PluginBase
{

    public $require = ['Rainlab.Builder'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Localize',
            'description' => 'No description provided yet...',
            'author'      => 'Inetis',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConsoleCommand('localize:addstrings', 'Inetis\Localize\Console\AddStrings');
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'inetis.localize.some_permission' => [
                'tab' => 'Localize',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'localize' => [
                'label'       => 'Localize',
                'url'         => Backend::url('inetis/localize/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['inetis.localize.*'],
                'order'       => 500,
            ],
        ];
    }
}
