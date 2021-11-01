# AdminUserManager plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/AdminUserManager
```
composer require symfony/yaml

bin/cake bake plugin AdminUserManager

bin/cake bake migration -p AdminUserManager createRoles listing_id:integer title:string[100] sort_order:integer created modified

bin/cake bake migration -p AdminUserManager createAdminUsers listing_id:integer title:string[10] first_name:string[80] middle_name:string?[50] last_name:string[100] mobile:string[15] dob:date email:string[180]:unique:EMAIL_INDEX profile_photo:string?[255] photo_dir:string?[255] photo_size:integer?[11] photo_type:string?[255] password:string[255] is_supper_admin:boolean? status:boolean is_verified:boolean? login_count:integer? created modified


bin/cake bake migration createUserTokens user_id:integer user_type:string[20] token_type:string[100] email:string[255] token:string:[255] created modified

bin/cake bake migration -p AdminUserManager createAdminUsersRoles role_id:integer:INDEX admin_user_id:integer:INDEX


bin/cake migrations migrate -p AdminUserManager

bin/cake bake all --plugin AdminUserManager roles --prefix admin -t BackEnd

bin/cake bake controller --plugin AdminUserManager admin_users --prefix admin -t BackEnd
bin/cake bake template --plugin AdminUserManager admin_users --prefix admin -t BackEnd
bin/cake bake model --plugin AdminUserManager admin_users


bin/cake bake policy AdminUser -p AdminUserManager
bin/cake bake policy Role -p AdminUserManager
bin/cake bake policy Roles -p AdminUserManager --type table





