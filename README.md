yii2-rights
===========

Don't use this module =) 

The module is under development, but I work to make it better.

install
--------

Until only manual installation.

clone to 'vendor' folder
open 'vendors/yyisoft/extensions.php' and paste:
```php
'de1phi/yii2-rights' => array (
    'name' => 'de1phi/yii2-rights',
    'version' => '0.0.0.1-beta',
    'alias' => array (
       '@de1phi/rights' => $vendorDir . '/de1phi/yii2-rights',
    ),
),
```
open 'vendors/de1phi/yii2-rights/controllers/AssignmentController.php' and edit line:
```php
use de1phi\user\models\User;
```
paste your model of user

open 'config/web.php' and add this code to 'modules':
```php
'rights' => [
    'class' => 'de1phi\rights\RightsModule',
],
```
and to 'components':
```php
'authManager' => [
    'class' => 'de1phi\rights\components\RightsManager',
    'defaultRoles' => ['Guest'],
],
```

add this url rules:
```php
'rights' => 'rights/assignment/index',
```
execute 'db.sql' script.
for managed permissions go to http://yoursite/rights
