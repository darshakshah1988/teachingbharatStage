# Cms plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/Cms
```

bin/cake bake plugin Cms

------------------------

	bin/cake bake migration -p Cms createPages listing_id:integer title:string[150] sub_title:string?[250] slug:string[250]:unique short_description:string[700] description:longtext banner:string?[255] banner_dir:string?[255] banner_size:integer?[11] banner_type:string?[50] meta_title:string meta_keyword:string[300] meta_description:text status:boolean created modified

	bin/cake bake migration -p Cms createNavigations listing_id:integer title:string[150] slug:string[250]:unique parent_id:integer?:PARENTID_INDEX menu_link:string[255] is_nav_type:integer[2] target:string[20] lft:integer rght:integer status:boolean is_top:boolean? is_bottom:boolean? position:integer created modified

	bin/cake bake migration -p Cms createModules listing_id:integer title:string[150] plugin:string?[120]:default:NULL controller:string[120] action:string[100] json_path:string?[700] query_string:string?[250] banner:string[200] banner:string?[255] banner_dir:string?[255] banner_size:integer?[11] banner_type:string?[50] meta_title:string meta_keyword:string[300] meta_description:text status:boolean created modified

	
	-------------------------------------------------------------------
	
	bin/cake migrations migrate -p Cms

	bin/cake bake controller --plugin Cms pages --prefix admin -t BackEnd  (this command use when you create new plugin)
	bin/cake bake template --plugin Cms pages --prefix admin -t BackEnd
	bin/cake bake model --plugin Cms pages


	bin/cake bake controller --plugin Cms modules --prefix admin -t BackEnd  (this command use when you create new plugin)
	bin/cake bake template --plugin Cms modules --prefix admin -t BackEnd
	bin/cake bake model --plugin Cms modules

	bin\cake bake all --plugin Cms pages --prefix admin -t BackEnd  (this command use when you create new plugin)
	bin\cake bake all --plugin Cms modules --prefix admin -t BackEnd (this command use when you create new plugin)
	bin\cake bake all --plugin Cms navigations --prefix admin -t BackEnd (this command use when you create new plugin)

	bin\cake bake seed Pages --plugin Cms (this command use when you create new plugin)
	bin\cake bake seed Modules --plugin Cms (this command use when you create new plugin)
	bin\cake bake seed Navigations --plugin Cms (this command use when you create new plugin)
	
	bin\cake migrations seed --seed PagesSeed --plugin Cms

	bin/cake bake controller --plugin Cms navigations --prefix admin -t BackEnd  (this command use when you create new plugin)
	bin/cake bake template --plugin Cms navigations --prefix admin -t BackEnd
	bin/cake bake model --plugin Cms navigations