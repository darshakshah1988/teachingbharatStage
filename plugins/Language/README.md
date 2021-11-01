# Language plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/language
```
bin/cake bake plugin Language

bin/cake bake migration -p Language createLanguages title:string[50] code:string?[5] locale:string?[100] image:string?[255] image_dir:string?[255] image_size:integer?[11] image_type:string?[50] position:integer?[11] status:boolean created modified

bin/cake migrations migrate -p Language

bin/cake bake controller --plugin Language languages -t BackEnd --prefix admin
bin/cake bake model --plugin Language languages

bin/cake bake template --plugin Language languages --prefix admin -t BackEnd