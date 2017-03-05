<?php

/**
 * User: Kirill Pomerantsev
 * Date: 25.02.2017
 * Time: 4:30
 */

namespace pkv\fontawesome;

class AssetBundle
	extends \yii\web\AssetBundle
{
	public $sourcePath = '@vendor/fortawesome/font-awesome';
	public $css
		= [
			'css/font-awesome.min.css',
		];
}