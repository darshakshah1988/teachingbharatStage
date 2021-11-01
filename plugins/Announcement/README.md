# Announcement plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/Announcement
```

bin/cake bake plugin Announcement

bin/cake bake controller --plugin Announcement announcements --prefix admin

bin/cake bake template --plugin Announcement announcements --prefix admin -t BackEnd


bin/cake bake model --plugin Announcement announcements


bin/cake bake migration_snapshot announcements --plugin Announcement --require-table

bin/cake bake migration_snapshot Initial --plugin Announcement --require-table

bin/cake bake cell Announcement --plugin Announcement


