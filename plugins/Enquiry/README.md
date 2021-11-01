# Enquiry plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/Enquiry
```

bin/cake bake plugin Enquiry

    bin/cake bake migration -p Enquiry createPriorityTypes listing_id:integer title:string[80] created modified

    bin/cake bake migration -p Enquiry createEnquiryStatuses listing_id:integer title:string[80] color:string[50] created modified

    bin/cake bake migration -p Enquiry createEnquiries listing_id:integer admin_user_id:integer?[11] enquiry_type:string[20] referred_by:string[200] subject:string[250] full_name:string?[250] mobile:string[15] email:string[180] address:string?[255] description:text? priority_type_id:integer?[11] enquiry_status_id:integer?[11] assigned_user_id:integer?[11] end_date:date? created modified

    bin/cake bake migration -p Enquiry createEnquiryComments enquiry_id:integer comment:text enquiry_status_id:integer[11] created modified

    bin/cake migrations migrate -p Enquiry

    bin/cake bake model --plugin Enquiry priority_types
    bin/cake bake model --plugin Enquiry enquiry_statuses
    bin/cake bake model --plugin Enquiry enquiries
    bin/cake bake model --plugin Enquiry enquiry_comments

    bin/cake bake controller --plugin Enquiry priority_types
    bin/cake bake controller --plugin Enquiry enquiry_statuses
    bin/cake bake controller --plugin Enquiry enquiries
    bin/cake bake controller --plugin Enquiry enquiry_comments


    bin/cake bake template --plugin Enquiry enquiry_statuses --prefix admin -t BackEnd

bin/cake bake policy Enquiries -p Enquiry --type table



bin/cake bake cell Enquiry --plugin Enquiry