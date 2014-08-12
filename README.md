yii2-rights
===========

Don't use this module =) 

The module is under development, but I work to make it better.

install
--------

Until only manual installation.

1. Clone to 'vendor' folder
2. open 'vendors/yyisoft/extensions.php' and paste:
```php
'de1phi/yii2-rights' => array (
    'name' => 'de1phi/yii2-rights',
    'version' => '0.0.0.1-beta',
    'alias' => array (
       '@de1phi/rights' => $vendorDir . '/de1phi/yii2-rights',
    ),
),
```
3. open 'vendors/de1phi/yii2-rights/controllers/AssignmentController.php' and edit line:
```php
use de1phi\user\models\User;
```
paste your model of user
4. open 'config/web.php' and add this code to 'modules':
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
5. add this url rules:
```php
'rights' => 'rights/assignment/index',
```
6. execute 'db.sql' script.
7. for managed permissions go to http://yoursite/rights
