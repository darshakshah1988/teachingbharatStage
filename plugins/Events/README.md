# Events plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/Events
```
bin/cake bake plugin Events

bin/cake bake migration -p Events createEvents admin_user_id:integer listing_id:integer title:string[250] sub_title:string?[250] short_description:string[400] description:text location:string?[255] organizar_name:string?[255] organizer_email:string?[255] organizer_contact_number:string?[20] banner:string?[250] banner_dir:string?[255] banner_size:integer?[11] banner_type:string?[50] start_date:date end_date:date description:text meta_title:string[200] meta_keyword:string[255] meta_description:string[255] status:boolean position:integer created modified

bin/cake bake migration -p Events createEventDocuments event_id:integer file_type:smallinteger title:string?[150] caption:string?[400] banner:string?[250] banner_dir:string?[255] banner_size:integer?[11] banner_type:string?[50] start_date:date end_date:date position:integer created modified

bin/cake bake migration -p Events createEventSocialLinks event_id:integer social_type:string social_url:string[255] position:integer? created modified


bin/cake migrations migrate -p Events

bin/cake bake controller --plugin Events events --prefix admin -t BackEnd
bin/cake bake template --plugin Events events --prefix admin -t BackEnd
bin/cake bake model --plugin Events events

bin/cake bake model --plugin Events event_documents
bin/cake bake model --plugin Events event_social_links

bin/cake bake cell Event --plugin Events

bin/cake bake controller --plugin Events events -t BackEnd