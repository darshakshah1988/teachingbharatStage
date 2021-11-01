# MicroSessions plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/micro-sessions
```

bin/cake bake migration -p MicroSessions createMicroSessions listing_id:integer slug:string[250] user_id:string[36] grading_type_id:integer academic_year_id:integer title:string[250] board_id:integer subject_id:integer duration:string?[255] price:decimal?[8,2] discount_price:decimal?[8,2] is_free:boolean short_description:string?[400] description:longtext? faq:longtext? microsession_file:string[255] microsession_file_dir:string?[255] microsession_file_size:integer?[11] microsession_file_type:string?[50] monday:string[30] tuesday:string[30] wednesday:string[30] thursday:string[30] friday:string[30] saturday:string[30] sunday:string[30] package_id:integer plan_id:integer start_date:date end_date:date lft:integer rght:integer status:boolean created modified


bin/cake bake migration -p MicroSessions createPackages user_id:string[36] package_name:string[256] package_title:string[256] grading_type_id:integer board_id:integer subject_id:string[250] short_description:string?[400] description:longtext? about:longtext? what_included:longtext? what_best:longtext? faq:longtext? package_file:string[255] package_file_dir:string?[255] package_file_size:integer?[11] package_file_type:string?[50] status:boolean created modified

bin/cake bake migration -p MicroSessions createPlans package_id:integer user_id:string[36] plan_name:string[256] duration:string?[255] price:decimal?[8,2] discount_price:decimal?[8,2]  features:string?[400] other_details:longtext? status:boolean created modified
  

 bin/cake migrations migrate -p MicroSessions

----------------------------------------------------  

bin/cake bake controller --plugin MicroSessions micro_sessions --prefix admin -t BackEnd

bin/cake bake controller --plugin MicroSessions micro_sessions

bin/cake bake template --plugin MicroSessions micro_sessions --prefix admin -t BackEnd
bin/cake bake template --plugin MicroSessions micro_sessions

bin/cake bake model --plugin MicroSessions micro_sessions



----------------------------------------------------

bin/cake bake migration -p MicroSessions createMicroSessionChapters micro_session_id:integer title:string[80] video_url:string[250] start_date:string[25] end_date:string[25]  start_time:string[25]  end_time:string[25]  chapter_file:string[255] chapter_file_dir:string?[255] chapter_file_size:integer?[11] chapter_file_type:string?[50] short_description:string?[400] description:text? position:integer is_free:boolean created modified

bin/cake bake controller --plugin MicroSessions micro_session_chapters --prefix admin -t BackEnd
bin/cake bake controller --plugin MicroSessions micro_session_chapters 

bin/cake bake template --plugin MicroSessions micro_session_chapters --prefix admin -t BackEnd
bin/cake bake template --plugin MicroSessions micro_session_chapters

bin/cake bake model --plugin MicroSessions micro_session_chapters

----------------------------------------------------  

bin/cake bake controller --plugin MicroSessions packages --prefix admin -t BackEnd

bin/cake bake controller --plugin MicroSessions packages

bin/cake bake template --plugin MicroSessions packages --prefix admin -t BackEnd
bin/cake bake template --plugin MicroSessions packages

bin/cake bake model --plugin MicroSessions packages

----------------------------------------------------  

bin/cake bake controller --plugin MicroSessions plans --prefix admin -t BackEnd

bin/cake bake controller --plugin MicroSessions plans

bin/cake bake template --plugin MicroSessions plans --prefix admin -t BackEnd
bin/cake bake template --plugin MicroSessions plans

bin/cake bake model --plugin MicroSessions plans


