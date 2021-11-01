# Listings plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/Listings
```


bin/cake bake plugin Listings

bin/cake bake migration -p Listings createListingTypes title:string[100] slug:string[180]:unique:SLUG_INDEX sort_order:integer created modified

bin/cake bake migration -p Listings createListingTypeCategories listing_type_id:integer title:string[100] sort_order:integer created modified

bin/cake bake migration -p Listings createListings admin_user_id:integer code:string[180]:unique:CODE_INDEX listing_type_id:integer parent_id:integer?[11] title:string[250] slug:string[250]:unique:SLUG_INDEX tag_line:string?[250] protocol:enum["https://","http://"] domain_name:string?[100] registration_no:string?[100] registration_date:date? logo:string?[255] logo_dir:string?[255] logo_size:integer?[11] logo_type:string?[50] banner:string?[255] banner_dir:string?[255] banner_size:integer?[11] banner_type:string?[50] thumb_image:string?[255] thumb_image_dir:string?[255] thumb_image_size:integer?[11] thumb_image_type:string?[50] location_id:integer address_line_1:string[150] address_line_2:string?[150] postcode:string[8] latitude:string?[80] longitude:string?[80] short_description:string[255] description:text meta_title:string[200] meta_keyword:string[255] meta_description:string[255] is_visible:boolean? status:boolean sort_order:integer created modified

bin/cake bake migration -p Listings createInstitutionTypes listing_id:integer title:string[100] sort_order:integer created modified

bin/cake bake migration -p Listings createListingDetails listing_id:integer listing_type_category_id:integer institution_type_id:integer classification:string?[100] classification:string?[100] created modified

bin/cake bake migration -p Listings createAcademicYears listing_id:integer title:string[50] start_date:date end_date:date classification:string?[100] classification:string?[100] created modified

bin/cake migrations migrate -p Listings

bin/cake bake controller --plugin Listings listing_types --prefix admin -t BackEnd
bin/cake bake template --plugin Listings listing_types --prefix admin -t BackEnd
bin/cake bake model --plugin Listings listing_types


bin/cake bake policy ListingType -p Listings
bin/cake bake policy ListingTypeTable -p Listings


bin/cake bake controller --plugin Listings listing_type_categories --prefix admin -t BackEnd
bin/cake bake template --plugin Listings listing_type_categories --prefix admin -t BackEnd
bin/cake bake model --plugin Listings listing_type_categories


bin/cake bake policy ListingTypeCategory -p Listings
bin/cake bake policy ListingTypeCategoriesTable -p Listings


bin/cake bake controller --plugin Listings listings --prefix admin -t BackEnd
bin/cake bake template --plugin Listings listings --prefix admin -t BackEnd
bin/cake bake model --plugin Listings listings


bin/cake bake policy Listing -p Listings
bin/cake bake policy ListingsTable -p Listings



------------------------------------------------------------------------------





