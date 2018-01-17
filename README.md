# About
OctoberCMS plugin to scaffold language files from localization strings in YAML files.

Adds the `artisan localize:addstrings {Author.Plugin} {lang-code}` command that will scan all the YAML files in `{Author.Plugin}` for language keys and add them to the `/plugins/{author}/{plugin}/lang/{lang-code}/lang.php` file.

For example, if you have the following file inside your plugin this command will add the `inetis.testplugin::lang.user.name` 
string to the language file with the default value `NEW_name`. This helps with finding language keys that haven't been translated yet.

```yaml
user_name:
    label: inetis.testplugin::lang.user.name
    span: auto
    type: text
    tab : Profile
```

## Usage
```
php artisan localize:addstrings {Author.Plugin} {lang-code}
```

Parameter | Explanation | Example 
------------- | ------------- | -------------
First | name of the plugin | Rainlab.Pages
Second | language abbreviation | en

If the destination language doesn't exist, this command will create it.

## Dependencies
This plugin requires [*Rainlab.Builder*](https://octobercms.com/plugin/rainlab-builder)

## Author
inetis is a webdesign agency in Vufflens-la-Ville, Switzerland. We love coding and creating powerful apps and sites  [see our website](https://inetis.ch).
