# oc-Localise-plugin
New artisan command to create language file from Yaml key

This command will scan all your Yaml files. It will look for new language keys. 


`yaml
inetis_emergency:
    label: inetis.transitec::lang.user.emergency
    span: auto
    type: text
    tab : Profile
`

## Command
`
php artisan localise:addstrings {Plugin.Name} {en}
`
First parameter : name of the plugin ex: Rainlab.
Second parameter : language abreviation ex: en

If the destination language don't exist. This pluging will create it.


## Dependency 
This plugin required *Rainlab.Builder*

## Author
inetis is a webdesign agency in Vufflens-la-Ville, Switzerland. We love coding and creating powerful apps and sites  [see our website](https://inetis.ch).

