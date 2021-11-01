# Services plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/Services
```
bin/cake bake plugin Services

bin/cake bake migration -p Services createServices listing_id:integer title:string[200] slug:string[250]:unique service_icon:string[150] short_description:string[400] description:longtext status:boolean position:integer created modified

bin/cake migrations migrate -p Services


bin/cake bake controller --plugin Services services --prefix admin -t BackEnd

bin/cake bake template --plugin Services services -t BackEnd

bin/cake bake template --plugin Services services --prefix admin -t BackEnd


bin/cake bake model --plugin Services services

bin/cake bake cell Service --plugin Services
