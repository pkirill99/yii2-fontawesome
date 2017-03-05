Font Awesome Helper
============
The iconic font and CSS toolkit

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist pkv/yii2-fontawesome "*"
```

or add

```
"pkv/yii2-fontawesome": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= pkv\fontawesome\Icon::get('twitter')->rotate(pkv\fontawesome\Icon::ROTATE_180)->border() ?>
<?= pkv\fontawesome\Icon::get('twitter', ['rotate' => pkv\fontawesome\Icon::ROTATE_180, 'border' => true]) ?>
```

```php
<?= pkv\fontawesome\Icon::stack()->in(pkv\fontawesome\Icon::get('cog')->spin())->on(['ban', ['options' => ['class' => 'text-danger']]]) ?>
<?= pkv\fontawesome\Icon::stack()->in(['cog', ['spin' => true]])->on(['ban', ['options' => ['class' => 'text-danger']]]) ?>
```

```php
<?= pkv\fontawesome\Icon::roster()->add('cog', 'settings')->add('twitter', 'twitter') ?>
```


Don't forget register asset bundle in view :

```php
<?php pkv\fontawesome\AssetBundle::register($this); ?>
```