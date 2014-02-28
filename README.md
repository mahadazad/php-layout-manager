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
- By default theme path is: */your_project/php-layout-manager/../themes/default/*
- By default layouts reside inside */your_project/php-layout-manager/../themes/default/layouts/*
- By default views reside inside */your_project/php-layout-manager/../themes/default/views/*
- Default layout is *main.php*
- Default theme folder name is *default*

Just include Theme.php file

```php
require_once /your_project/php-layout-manager/../inc.php

$manager = new Theme();
$manager->addScript('asdf');
$manager->render('test', array('name' => 'Muhammad Mahad Azad'));
```


This piece of code will render */your_project/php-layout-manager/../themes/default/views/test.php* and you can access *$name* variable inside this view file which will have value *'Muhammad Mahad Azad'*

This view will be wrapped inside */your_project/php-layout-manager/../themes/default/layouts/main.php* the layout files have special variable **$content** which contains the views that are being rendered.

You can use addStyle and addScript inside your views/layouts/controllers

Methods Available:
==================

Method | Parameters | Description
--- | --- | ---
render | $file, $data = array(), $return = false | renders the view file wrapped inside layout file, $data contains parameters which will be exposed as variables inside the view file; keys will become variable name inside view file, if return is true the output is not rendered instead returned.
renderPartial | $file, $data = array(), $return = false | Same as render() method only difference is it does not wrap the view file inside layout.
addScript | $script, $priority = NULL | Add .js file in head of the layout
addStyle | $style, $priority = NULL | Add .css file in head of the layout
setThemePath | $themePath | Sets the theme path default to: ./../themes/default/
setLayout | $layout | Layout name without .php inside layouts folder
layoutFolder | $layoutFolder | Layout folder inside themes folder
viewFolder | $viewFolder | Views folder inside themes folder

You can easily integrate this library with codeigniter:
==========================================================
- Copy the files inside your codeigniter project */ci_root/application/libraries*
- For ease of use lets extend core CI_Controller:
```php
// /ci_root/application/core/MY_Controller.php
class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        require_once dirname(__FILE__) . '/../libraries/inc.php';
        $this->load->library('theme');
        $this->theme->setThemePath(dirname(__FILE__) . '/../themes/default/');
    }

}
```
- Now extend your controllers with MY_Controller instead of CI_Controller

```php
// /ci_root/application/controllers/Welcome.php
class Welcome extends MY_Controller {

    public function index() {
        // renders /ci_project/application/themes/default/views/welcome_message.php
        // and wraps it into /ci_project/application/themes/default/layouts/main.php
        $this->theme->render('welcome_message');
    }

}

```

```php
<!-- // /ci_root/application/themes/default/layouts/main.php -->
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <?php echo $content ?>
    </body>
</html>
```


```php
<!-- // /ci_root/application/themes/default/views/welcome_message.php -->
<?php
  // add script on demand
  $this->addScript(base_url() . '/my_welcome_message.js')
?>
Hello World!
```
