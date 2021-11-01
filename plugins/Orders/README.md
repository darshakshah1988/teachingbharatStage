# Orders plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/orders
```

bin/cake bake plugin Orders

bin/cake bake migration -p Orders createOrders invoice_no:string?[150] user_id:uuid amount:decimal?[8,2] discount:decimal?[8,2] total_amount:decimal?[8,2] order_date:datetime? razorpay_order:string?[255] note:text? invoice_file:string?[255] created modified

bin/cake bake migration -p Orders createOrderCourses order_id:integer course_id:integer amount:decimal?[8,2] discount:decimal?[8,2] total_amount:decimal?[8,2] created modified

bin/cake bake migration -p Orders createCarts user_id:uuid sessionId:string?[255] course_id:integer quantity:smallinteger created modified


bin/cake bake migration -p Orders AddPaymentFieldsToOrders payment_method:string?[50] transaction_status:smallint? transactionId:string?[255] signature:string? transaction_responce:longtext?

bin/cake bake migration -p Orders AddAdditionalOptionsToOrders additional_options:text?

bin/cake bake migration -p Orders AddIsCertificateSentToOrders is_certificate_sent:smallinteger?
bin/cake bake migration -p Orders AddCertificateIssueDateToOrders certificate_issue_date:datetime?

// New field for cart
bin/cake bake migration -p Orders AddNewFieldsToCarts micro_session_id:integer? package_id:integer? plan_id:integer?

// New field for Order
bin/cake bake migration -p Orders AddNewFieldsToOrderCourses micro_session_id:integer? package_id:integer? plan_id:integer?

// TeacherStudentMappings

bin/cake bake migration -p Orders createTeacherStudentMappings student_id:uuid package_id:integer  subject_id:integer micro_session_id teacher_id:uuid created modified


bin/cake migrations migrate -p Orders


bin/cake bake controller --plugin Orders carts --prefix admin -t BackEnd

bin/cake bake model --plugin Orders carts

bin/cake bake template --plugin Orders carts --prefix admin -t BackEnd


bin/cake bake controller --plugin Orders orders -t BackEnd

bin/cake bake model --plugin Orders orders

bin/cake bake model --plugin Orders order_courses

bin/cake bake template --plugin Orders orders -t BackEnd


bin/cake bake model --plugin Orders order_coupons

bin/cake bake model --plugin Orders teacher_student_mappings

bin/cake bake controller --plugin Orders teacher_student_mappings


