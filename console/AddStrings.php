<?php namespace Inetis\Localize\Console;

use File;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use RainLab\Builder\Classes\LocalizationModel;
use Symfony\Component\Console\Input\InputArgument;
use System\Classes\PluginManager;
use Yaml;

class AddStrings extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'localize:addstrings';

    /**
     * @var string The console command description.
     */
    protected $description = 'Extract language keys from Yaml and create a language file';

    /**
     * @var string language code.
     */
    protected $languageCode;

    /**
     * @var string plugin name
     */
    protected $pluginName;

    /**
     * @var string plugin directory
     */
    protected $pluginDir;

    /**
     * Execute the console command.
     *
     * @return void
     * @throws \ApplicationException
     * @throws \ValidationException
     */
    public function handle()
    {
        $this->initValues();
        $files = $this->getAllFiles();
        $keys = $this->extractYaml($files['yaml']);
        $this->createYamlFileIfNotExist();
        $this->addKeysToYaml($keys);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['pluginName', InputArgument::REQUIRED, 'Plugin name'],
            ['languageCode', InputArgument::REQUIRED, 'Language en/fr/..'],
        ];
    }

    /**
     * Recursive get all files
     *
     * @return array
     */
    private function getAllFiles()
    {
        $files = [];
        $directoryIterator = new \RecursiveDirectoryIterator($this->pluginDir);
        foreach (new \RecursiveIteratorIterator($directoryIterator) as $filename => $file) {
            if ($file->isFile()) {
                $files[$file->getExtension()][] = $file;
            }
        }

        return $files;
    }

    /**
     * Extract key from YAML files
     *
     * @param array $yamlFiles
     *
     * @return Collection
     */
    private function extractYaml($yamlFiles)
    {
        $localisationKeys = array();
        foreach ($yamlFiles as $yamlFile) {
            $localisationKeys[] = collect(Yaml::parseFile($yamlFile));
        }
        $localisationKeys = collect($localisationKeys);

        $keys = $localisationKeys->flatten()->filter(function ($value, $key) {
            return str_contains($value, strtolower($this->pluginName) . '::');
        });
        $keys = $keys->values()->unique();

        return $keys;
    }

    /**
     * Add new keys to the language file
     *
     * @param Collection $keys
     *
     * @return int
     * @throws \ApplicationException
     * @throws \ValidationException
     */
    private function addKeysToYaml(Collection $keys)
    {
        $pluginNameLowerCase = strtolower($this->pluginName);
        $numberOfAddedKeys = 0;
        $model = new LocalizationModel();
        $model->setPluginCode($this->pluginName);

        foreach ($keys->sort() as $value) {
            $model->load($this->languageCode);
            $value = str_replace($pluginNameLowerCase . '::lang.', '', $value);
            $keyValue = array_get($model->getOriginalStringsArray(), $value, 0);

            if (!$keyValue) {
                $content = explode('.', $value)[1];
                $model->createStringAndSave($value, 'NEW_' . $content);

                $this->output->writeln($value);
                $numberOfAddedKeys++;
            }
        }

        $this->output->writeln($numberOfAddedKeys . ' keys have been added to ');
        $this->output->writeln($this->pluginDir . '/lang/' . $this->languageCode . '/lang.php');

        return $numberOfAddedKeys;
    }

    /**
     * @return void
     */
    private function initValues()
    {
        $this->pluginName = PluginManager::instance()->normalizeIdentifier($this->argument('pluginName'));
        $this->languageCode = strtolower($this->argument('languageCode'));

        if (!PluginManager::instance()->exists($this->pluginName)) {
            throw new \InvalidArgumentException(sprintf('Plugin "%s" not found.', $this->pluginName));
        }

        $this->pluginDir = PluginManager::instance()->getPluginPath($this->pluginName);
    }

    private function createYamlFileIfNotExist()
    {
        if (!LocalizationModel::languageFileExists($this->pluginName, $this->languageCode)) {
            $languageDirectory = $this->pluginDir . '/lang/' . $this->languageCode;
            File::makeDirectory($languageDirectory);
            File::put($languageDirectory . '/lang.php', '<?php return [];'); // populate with an empty array
            $this->output->writeln($languageDirectory . '/lang.php file created');
        }
    }
}
