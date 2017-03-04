<?php
/**
 * User: Kirill Pomerantsev
 * Date: 25.02.2017
 * Time: 4:30
 */

namespace pkv\fontawesome;

use  yii\web\AssetBundle;

class Asset
	extends AssetBundle
{
	public $sourcePath = '@vendor/fortawesome/font-awesome';
	public $css
		= [
			'css/font-awesome.min.css',
		];
}