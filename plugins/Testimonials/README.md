# Testimonials plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/Testimonials
```

bin/cake bake plugin Testimonials

bin/cake bake migration -p Testimonials createTestimonials listing_id:integer name:string[200] designation:string?[200] description:text status:boolean created modified

bin/cake migrations migrate -p Testimonials

bin/cake bake controller --plugin Testimonials testimonials --prefix admin -t BackEnd

bin/cake bake template --plugin Testimonials testimonials --prefix admin -t BackEnd


bin/cake bake model --plugin Testimonials testimonials

bin/cake bake cell Testimonials --plugin Testimonial