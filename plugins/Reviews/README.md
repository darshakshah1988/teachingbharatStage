# Reviews plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/reviews
```
bin/cake bake plugin Reviews

bin/cake bake migration -p Reviews createReviews user_id:uuid course_id:integer name:string rating:integer description:text? photo:string?[255] photo_dir:string?[255] photo_size:integer?[6] photo_type:string?[255] created modified

bin/cake bake migration -p Reviews AddReviewTypeToReviews review_type:string?[100] course_id:integer?

bin/cake bake migration -p Reviews AddLocationNDesignationToReviews designation:string?[255] location:string?[255]


bin/cake migrations migrate -p Reviews

bin/cake bake controller --plugin Reviews reviews --prefix admin -t BackEnd

bin/cake bake model --plugin Reviews reviews

bin/cake bake template --plugin Reviews reviews --prefix admin -t BackEnd

bin/cake bake cell Reviews --plugin Reviews