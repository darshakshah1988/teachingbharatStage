# Promotions plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/promotions
```

bin/cake bake migration -p Promotions createCoupons name:string[250] code:string[250] coupon_type:string[25] discount:decimal[8,2] total:decimal?[8,2] date_start:date? date_end:date? uses_total:integer uses_customer:integer status:boolean created modified

bin/cake bake migration -p Promotions createOrderCoupons order_id:integer coupon_id:integer user_id:uuid amount:decimal?[8,2] created modified


bin/cake migrations migrate -p Promotions

bin/cake bake controller --plugin Promotions coupons --prefix admin -t BackEnd

bin/cake bake model --plugin Promotions coupons

bin/cake bake template --plugin Promotions coupons --prefix admin -t BackEnd