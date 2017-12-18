<?php namespace Inetis\Localize;

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
            'description' => 'Artisan command to generate language files from localization strings inside Yaml files',
            'author'      => 'inetis',
            'icon'        => 'icon-language',
            'homepage'    => 'https://octobercms.com/plugin/inetis-localize',
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConsoleCommand('localize:addstrings', \Inetis\Localize\Console\AddStrings::class);
    }
}
