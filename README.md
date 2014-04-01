TinyMCE Widget for Yii2
=======================

Renders a [TinyMCE WYSIWYG text editor plugin](http://www.tinymce.com/) widget.

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require "2amigos/yii2-tinymce-widget" "*"
```
or add

```json
"2amigos/yii2-tinymce-widget" : "*"
```

to the require section of your application's `composer.json` file.

Usage
-----

```

use dosamigos\tinymce\TinyMce;

<?= $form->field($model, 'text')->widget(TinyMce::className(), [
    'options' => ['rows' => 6],
    'language' => 'es',
    'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]);?>
```

Further Information
-------------------
Please, check the [TinyMCE plugin site](http://www.tinymce.com/wiki.php/Configuration) documentation for further information about its configuration options.


> [![2amigOS!](http://www.gravatar.com/avatar/55363394d72945ff7ed312556ec041e0.png)](http://www.2amigos.us)  
<i>Web development has never been so fun!</i>  
[www.2amigos.us](http://www.2amigos.us)