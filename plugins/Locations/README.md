# Locations plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/Locations
```


bin/cake bake plugin Locations

bin/cake migrations migrate -p Locations


bin/cake bake model --plugin Locations locations

bin/cake bake controller --plugin Locations locations --prefix admin -t BackEnd

bin/cake bake template --plugin Locations locations --prefix admin -t BackEnd 


bin/cake bake migration -p Locations createLocations parent_id:integer?[11] title:string?[200] slug:string?[220] latitude:string?[80] longitude:string?[80] iso_alpha2_code:string?[10] iso_alpha3_code:string?[10] iso_numeric_code:integer?[5] formatted_address:text? lft:integer[11] rght:integer[11] meta_title:string?[250] meta_keyword:string?[300] meta_description:text? created modified