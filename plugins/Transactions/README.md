# Transactions plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/transactions
```

bin/cake bake plugin Transactions
--------------------------------------------


bin/cake bake migration -p Transactions createTransactions user_id:uuid payment_method:string[50] transaction_type:smallint transaction_status:smallint amount:decimal?[8,2] transactionId:string?[150] transaction_responce:text? note:text? created modified

bin/cake migrations migrate -p Transactions 


bin/cake bake controller --plugin Transactions transactions -t BackEnd
bin/cake bake model --plugin Transactions transactions
bin/cake bake template --plugin Transactions transactions -t BackEnd