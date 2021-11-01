# Settings plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/Settings
```

Settings
-----------------------------------------------------------------------------------------------------------------------
bin/cake bake plugin Settings

    bin/cake bake migration -p Settings createSettings listing_id:integer title:string[150] slug:string[255]:unique config_value:text manager:string[50] field_type:string[150] created modified

    bin/cake migrations migrate -p Settings

    bin/cake bake controller --plugin Settings settings --prefix admin -t BackEnd
    bin/cake bake template --plugin Settings settings --prefix admin -t BackEnd
    bin/cake bake model --plugin Settings settings

	bin/cake bake all --plugin Settings settings --prefix admin -t BackEnd		(this command use when you create new plugin)
	bin/cake bake all --plugin Settings settings --prefix admin -t BackEnd		(this command use when you create new plugin)
	bin/cake bake all --plugin Settings settings --prefix admin -t BackEnd		(this command use when you create new plugin)


    bin/cake bake policy --type entity Setting -p Settings
    bin/cake bake policy --type table Settings -p Settings

