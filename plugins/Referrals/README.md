# Referrals plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/referrals
```

bin/cake bake plugin Referrals
-----------------------------------



bin/cake bake migration -p Referrals AddCodeNReferralToUsers code:string?[50]


bin/cake bake migration -p Referrals createTransactions user_id:uuid transaction_type:smallint transaction_status:smallint amount:decimal?[8,2] transactionId:string?[150] transaction_responce:text? note:text? created modified

bin/cake migrations migrate -p Referrals

bin/cake bake controller --plugin Referrals referrals -t BackEnd

bin/cake bake controller --plugin Referrals transactions -t BackEnd

bin/cake bake template --plugin Referrals transactions -t BackEnd

bin/cake bake model --plugin Referrals transactions

transactions
	--id
	--user_id
	--transaction_type (1: deposit, 2: withdraw)
	--transaction_status (0 => Pending, 1: Success, 2: Canceled, 3 => Failed )
	--amount
	--transactionId
	--transaction_responce