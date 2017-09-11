<?php namespace Inetis\Localise;

use Backend;
use System\Classes\PluginBase;

/**
 * Localise Plugin Information File
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
            'name'        => 'Localise',
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
        $this->registerConsoleCommand('localise:addstrings', 'Inetis\Localise\Console\AddStrings');
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
            'inetis.localise.some_permission' => [
                'tab' => 'Localise',
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
            'localise' => [
                'label'       => 'Localise',
                'url'         => Backend::url('inetis/localise/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['inetis.localise.*'],
                'order'       => 500,
            ],
        ];
    }
}
