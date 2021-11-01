# UserManager plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/user-manager
```

bin/cake bake plugin UserManager


bin/cake bake controller --plugin UserManager users --prefix admin -t BackEnd

bin/cake bake template --plugin UserManager users -t BackEnd

bin/cake bake template --plugin UserManager occupations --prefix admin -t BackEnd


bin/cake bake model --plugin UserManager users

bin/cake bake controller --plugin UserManager occupations -t BackEnd --prefix admin
bin/cake bake model --plugin UserManager occupations

bin/cake bake template --plugin UserManager occupations --prefix admin -t BackEnd

bin/cake bake migration -p UserManager createOccupations title:string[100] status:boolean created modified

bin/cake bake migration -p UserManager createUsersGradingTypes user_id:uuid grading_type_id:integer 

bin/cake bake migration -p UserManager createUserProfiles user_id:uuid alt_mobile:string?[20] dob:date? location_id:integer? address_line_1:string?[150] address_line_2:string?[150] postcode:string?[8] latitude:string?[80] longitude:string?[80] gender:string?[10] qualification:string?[250] college_university:string?[250] occupation_id:integer? experience:string?[50] primary_subject_id:integer? secondary_subject_id:integer? hours_inweekdays:smallint? hours_inweekend:smallint? is_digital_pen_tablet:boolean? is_internet_speed_mbps:boolean? source_of_rudraa:string? resume:string?[255] resume_dir:string?[255] resume_size:integer?[11] resume_type:string?[80] created modified

 
bin/cake bake migration -p UserManager createUserDocuments user_id:uuid document_type_id:integer document_file:string?[255] document_dir:string?[255] document_size:integer?[8] document_type:string?[150]


bin/cake bake migration -p UserManager AddListingIdToUsers listing_id:integer?

bin/cake bake migration -p UserManager AddGradingTypeIdToUserProfiles grading_type_id:integer?

bin/cake bake migration -p UserManager AddProfilePhotoToUsers profile_photo:string?[255] photo_dir:string?[255] photo_size:integer?[6] photo_type:string?[255]

bin/cake bake migration -p UserManager AddCommentToUsers comment:text?

bin/cake bake migration -p UserManager AddReferredByToUsers referred_by:uuid?

bin/cake bake migration -p UserManager AddExperienceMonthToUserProfiles experience_month:integer?


bin/cake bake migration -p UserManager AddNewColumnToUserProfiles achievement:string?[250] other_achievement:string?[250] digital_experience:string?[250]


bin/cake migrations migrate -p UserManager

bin/cake bake model --plugin UserManager user_profiles



bin/cake bake migration -p UserManager createTeacherSchedules title:string[100] start_at:time[6] end_at:time[6] status:boolean created modified


bin/cake bake migration -p UserManager createUsersTeacherSchedules user_id:uuid teacher_schedule_id:integer

bin/cake bake migration -p UserManager createUsersLanguages user_id:uuid language_id:integer


bin/cake bake controller --plugin UserManager teacher_schedules -t BackEnd --prefix admin


bin/cake bake model --plugin UserManager teacher_schedules

bin/cake bake template --plugin UserManager teacher_schedules -t BackEnd --prefix admin

bin/cake bake controller --plugin UserManager user_documents -t BackEnd
bin/cake bake template --plugin UserManager user_documents -t BackEnd 
bin/cake bake model --plugin UserManager user_documents

bin/cake bake migration -p UserManager createUsersBoards user_id:uuid board_id:integer

bin/cake bake migration -p UserManager AddRateToUserProfiles rate:decimal?[8,2]


bin/cake bake migration -p UserManager AddMobileVerifyNOptToUserProfiles is_mobile_verified:boolean? sms_otp:string?[20]

bin/cake bake migration -p UserManager AddPasswordToUserProfiles password:text?