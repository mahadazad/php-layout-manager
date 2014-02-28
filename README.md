php-layout-manager
==================

A simple PHP layout manager which can be integrated with any PHP project.


Usecase:
============
Suppose you are working on a PHP project and:
- You want different themes, e.g. your backend and frontend has different themes.
- You want to use different layouts e.g. main layout, reduced layout, etc.
- You want to include you assets (js, css) on demand rather than adding all the assets in your layout file.
 
How to use:
==========
- By default theme path is: */your_project/application/themes/default/*
- By default layouts reside inside */your_project/application/themes/default/layouts/*
- By default views reside inside */your_project/application/themes/default/views/*
- Default layout is *main.php*
- Default theme folder name is *default*

Just include Theme.php file

```php
require_once /project/php-layout-manager/Theme.php

$manager = new Theme();
$manager->addScript('asdf');
$manager->render('test', array('name' => 'Muhammad Mahad Azad'));
```


This piece of code will render */your_project/application/themes/default/views/test.php* and you can access *$name* variable inside this view file which will have value *'Muhammad Mahad Azad'*

This view will be wrapped inside */your_project/application/themes/default/layouts/main.php* the layout files have special variable **$content** which contains the views that are being rendered.

