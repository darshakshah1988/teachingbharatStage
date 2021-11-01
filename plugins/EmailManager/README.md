# EmailManager plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/EmailManager
```


EmailManager
-----------------------------------------------------------------------------------------------------------------------
bin\cake bake plugin EmailManager

	bin\cake plugin load -b -r EmailManager (Adding the -b or -r switch to the load task will enable loading of the plugin’s bootstrap and routes values:)

	bin\cake bake migration -p EmailManager createEmailPreferences title:string[150] layout_html:text status:boolean created modified
	bin\cake bake migration -p EmailManager createEmailHooks title:string[150] slug:string[150]:unique description:text status:boolean created modified
	bin\cake bake migration -p EmailManager createEmailTemplates email_hook_id:integer subject:string[150] description:text footer_text:text email_hook_id:integer:EMAILHOOK_INDEX email_preference_id:integer:EMAILPREFRENCE_INDEX status:boolean created modified


	bin/cake bake migration -p EmailManager AddTemplateTypeToEmailTemplates template_type:integer?

	bin\cake migrations migrate -p EmailManager

	bin\cake bake all --plugin EmailManager email_hooks --prefix admin -t BackEnd		(this command use when you create new plugin)
	bin\cake bake all --plugin EmailManager email_preferences --prefix admin -t BackEnd		(this command use when you create new plugin)
	bin\cake bake all --plugin EmailManager email_templates --prefix admin -t BackEnd		(this command use when you create new plugin)

	bin\cake bake seed EmailHooks --plugin EmailManager	(this command use when you create new plugin)
	bin/cake migrations seed --seed EmailHooksSeed --plugin EmailManager


	bin\cake bake seed EmailPreferences --plugin EmailManager (this command use when you create new plugin)
	bin\cake migrations seed --seed EmailPreferencesSeed --plugin EmailManager

	--if you have seeding file then do not used this command  bin\cake bake seed EmailTemplates --plugin EmailManager
	bin\cake migrations seed --seed EmailTemplatesSeed --plugin EmailManager

    bin/cake bake policy --type entity EmailHook -p EmailManager
    bin/cake bake policy --type entity EmailPreference -p EmailManager
    bin/cake bake policy --type entity EmailTemplate -p EmailManager

    ##bin/cake bake policy EmailHook -p EmailManager
    ##bin/cake bake policy EmailHooksTable -p EmailManager


EmailQueue Plugin 1.
----------------------------------------------------------------------------------------------------
composer require dereuromark/cakephp-queue

$this->addPlugin('Queue', ['bootstrap' => false, 'routes' => true]);

bin/cake migrations migrate -p Queue

composer require dereuromark/cakephp-tools 	//for html tools


Detail: In this plugin we need to change send email code according custom smtp detail and latest version (added new function in EmailTemplatesController: logs, logView, queueLogs etc.. )
