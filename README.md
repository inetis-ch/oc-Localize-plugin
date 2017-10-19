# Localize
New artisan command to create language file from Yaml key

This command will scan all your Yaml files. It will look for new language keys and add them into your `lang/{lang-code}/lang.php` file. 

By example if you have the following file inside your plugin, this command will add the `inetis.testplugin::lang.user.name` 
string to your lang file with for default value `NEW_name` that help you to quickly find not already translated items.

```yaml
inetis_emergency:
    label: inetis.testplugin::lang.user.name
    span: auto
    type: text
    tab : Profile
```

## Command
```
php artisan localize:addstrings {Plugin.Name} {Lang}
```

Parameter | Definition | Exemple 
------------- | ------------- | -------------
First | name of the plugin | Rainlab.Page
Second | language abreviation | en

If the destination language doesn't exist. This pluging will create it.


## Dependency 
This plugin required *Rainlab.Builder*

## Author
inetis is a webdesign agency in Vufflens-la-Ville, Switzerland. We love coding and creating powerful apps and sites  [see our website](https://inetis.ch).

