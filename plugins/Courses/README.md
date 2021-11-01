# Courses plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/Courses
```

bin/cake bake plugin Courses
-----------------------------------------


bin/cake bake migration -p Courses createStandards grading_type_id:integer title:string[250] position:integer status:boolean created modified



bin/cake bake migration -p Courses createGradingTypes listing_id:integer title:string[250] position:integer created modified

bin/cake bake migration -p Courses createCourses listing_id:integer parent_id:integer? grading_type_id:integer academic_year_id:integer title:string[250] section_name:string[250] code:string?[100] start_date:date end_date:date lft:integer rght:integer status:boolean position:integer created modified

bin/cake bake migration -p Courses createSubjects course_id:integer title:string[80] max_weekly_classes:integer[5] credit_hours:integer[5] is_activity:boolean is_exam:boolean position:integer created modified

bin/cake bake migration -p Courses createSubjectsTeachers subject_id:integer teacher_id:integer created modified

bin/cake bake migration -p Courses AddSubjectNSeatsToCourses board_id:integer subject_id:integer duration:string?[255] price:decimal?[8,2] discount_price:decimal?[8,2] is_free:boolean sample_video:string?[250] short_description:string?[400] description:longtext?

bin/cake bake migration -p Courses AddUserIdToCourses user_id:uuid

bin/cake bake migration -p Courses createCourseChapters course_id:integer title:string[80] video_url:string[250] chapter_file:string[255] chapter_file_dir:string?[255] chapter_file_size:integer?[11] chapter_file_type:string?[50] short_description:string?[400] description:text? position:integer is_free:boolean created modified

curriculum

bin/cake bake migration -p Courses createCourseCurriculums course_chapter_id:integer title:string[80] video_url:string[250] chapter_file:string[255] chapter_file_dir:string?[255] chapter_file_size:integer?[11] chapter_file_type:string?[50] short_description:string?[400] description:text? position:integer created modified

bin/cake bake migration -p Courses createCourseWatchings course_id:integer user_id:uuid views:integer? created modified


bin/cake bake migration -p Courses AddCourseTypeToCourses course_type:integer?

bin/cake bake migration -p Courses AddPastCourseUrlToCourses course_url:string?

bin/cake bake migration -p Courses AddStartDateTypeToCourses start_date:datetime?

bin/cake bake migration -p Courses AddWatchingToCourses watching:integer?


bin/cake bake migration -p Courses createSubjectsTeachers user_id:uuid grading_type_id:integer

bin/cake bake migration -p Courses AddSlugToCourses slug:string?

bin/cake bake migration -p Courses AddFeaturesToCourses features:text?

bin/cake bake migration -p Courses AddWhatLearnToCourses what_learn:text?


bin/cake migrations migrate -p Courses 

----------------------------------------------------

bin/cake bake controller --plugin Courses courses --prefix admin -t BackEnd

bin/cake bake template --plugin Courses courses --prefix admin -t BackEnd

bin/cake bake model --plugin Courses courses

bin/cake bake template --plugin Courses courses --prefix admin -t BackEnd

bin/cake bake model --plugin Courses course_watchings


bin/cake bake controller --plugin Courses grading_types --prefix admin -t BackEnd

bin/cake bake template --plugin Courses grading_types --prefix admin -t BackEnd

bin/cake bake model --plugin Courses grading_types

bin/cake bake all --plugin Courses subjects --prefix admin -t BackEnd


bin/cake bake controller --plugin Courses course_chapters -t BackEnd

bin/cake bake template --plugin Courses course_chapters -t BackEnd


bin/cake bake model --plugin Courses course_chapters

-----------------------------------------------------------------------

bin/cake bake migration -p Courses createBoards listing_id:integer title:string[250] position:integer created modified

bin/cake migrations migrate -p Courses

bin/cake bake controller --plugin Courses boards --prefix admin -t BackEnd

bin/cake bake template --plugin Courses boards --prefix admin -t BackEnd

bin/cake bake model --plugin Courses boards





bin/cake bake cell Courses --plugin Courses


bin/cake bake controller --plugin Courses courses --prefix admin -t BackEnd

bin/cake bake template --plugin Courses courses --prefix admin -t BackEnd

bin/cake bake model --plugin Courses courses

--------------------------

custom 

ALTER TABLE `courses` CHANGE `description` `description` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL; 

ALTER TABLE `course_chapters` CHANGE `description` `description` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL; 