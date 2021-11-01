# Media plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/Media
```


bin/cake bake plugin Media
---------------------------------------------

bin/cake bake migration -p Media createMedias listing_id:integer media_type:enum["banner","gallery","video"] title:string[250] status:boolean position:integer created modified

bin/cake bake migration -p Media createMediaFiles media_id:integer title:string[150] sub_title:string?[250] description:longtext external_link:string?[255] media_image:string?[255] media_image_dir:string?[255] media_image_size:integer?[11] media_image_type:string?[50] status:boolean created modified

bin/cake migrations migrate -p Media

bin/cake bake controller --plugin Media medias --prefix admin -t BackEnd  (this command use when you create new plugin)
bin/cake bake template --plugin Media medias --prefix admin -t BackEnd (this command use when you create new plugin)
bin/cake bake model --plugin Media medias  (this command use when you create new plugin)

bin/cake bake model --plugin Media media_files

bin/cake bake controller --plugin Media medias -t BackEnd