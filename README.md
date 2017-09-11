# oc-Localize-plugin
New artisan command to create language file from Yaml key

This command will scan all your Yaml files. It will look for new language keys and add them into your `lang.php` file. 


```yaml
inetis_emergency:
    label: inetis.transitec::lang.user.emergency
    span: auto
    type: text
    tab : Profile
```

## Command
```
php artisan localize:addstrings {Plugin.Name} {en}
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

