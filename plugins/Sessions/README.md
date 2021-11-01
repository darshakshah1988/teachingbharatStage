# Sessions plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/sessions
```

bin/cake bake plugin Sessions

bin/cake bake migration -p Sessions createSessionBookings user_id:uuid subject_id:integer grading_type_id:integer board_id:integer booking_date:date? teacher_schedule_id:integer razorpay_order:string?[255] note:text? payment_method:string?[50] transaction_status:smallint? transactionId:string?[255] signature:string? transaction_responce:longtext? created modified

bin/cake bake migration -p Sessions AddTeacherIdToSessionBookings teacher_id:uuid

bin/cake bake migration -p Sessions AddTopicStatusToSessionBookings topic:string?[255] comment:text? session_status:smallint?

bin/cake bake migration -p Sessions AddTeacherCommentToSessionBookings teacher_comment:text? end_date:datetime?

bin/cake bake migration -p Sessions AddReasonToSessionBookings reason:text?

bin/cake migrations migrate -p Sessions

bin/cake bake model --plugin Sessions session_bookings

bin/cake bake controller --plugin Sessions session_bookings -t BackEnd

bin\cake bake migration -p Sessions CreateZoomMeetings user_id:uuid uuid:string?[100] meeting_id:biginteger?[50] host_id:string?[100] host_email:string?[200] topic:text type:integer status:string?[20] start_time:datetime duration:integer timezone:string?[100] created_at:datetime start_url:string?[300] join_url:string?[300] password:string?[20] h323_password:string?[20] pstn_password:string?[20] encrypted_password:string?[200] settings:text

session_bookings
	--id
	--subject_id
	--grading_type_id
	--board_id
	--booking_date
	--teacher_schedule_id
	--booking_status
	--comment
	--created
	--modified 


	bin/cake bake cell -p Sessions session 

