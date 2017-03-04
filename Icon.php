<?php
/**
 * User: Kirill Pomerantsev
 * Date: 26.02.2017
 * Time: 1:18
 */

namespace pkv\fontawesome;

use yii\base\Object;
use yii\helpers\Html;

/**
 *
 * @property boolean $inverse
 * @property boolean $spin
 * @property boolean $pulse
 * @property boolean $fw
 * @property boolean $li
 * @property boolean $border
 * @property boolean $pull
 * @property boolean $size
 * @property boolean $rotate
 * @property boolean $flip
 * @property boolean $component
 *
 *
 * @method  Icon inverse($value = true)
 * @method  Icon spin($value = true)
 * @method  Icon pulse($value = true)
 * @method  Icon fw($value = true)
 * @method  Icon li($value = true)
 * @method  Icon border($value = true)
 * @method  Icon pull($value = null)
 * @method  Icon size($value = null)
 * @method  Icon rotate($value = null)
 * @method  Icon flip($value = null)
 * @method  Icon component($value = null)
 *
 *
 */
class Icon
	extends Object
{
	public $tag = "i";
	public $prefix = self::PREFIX;
	/*
	 * extension
	 */
	public $inverse = false;
	public $spin = false;
	public $pulse = false;
	public $fw = false;
	public $li = false;
	public $border = false;
	public $pull = null;
	public $size = null;
	public $rotate = null;
	public $flip = null;
	public $component = null;
	/*
	 * html options
	 */
	public $options = [];
	/*
	 * constants
	 */
	const PREFIX = "fa";
	//
	const PARAMS = ['inverse', 'spin', 'pulse', 'fw', 'li', 'border', 'pull', 'size', 'rotate', 'flip', 'component'];
	//
	const PULL_LEFT = "pull-left";
	const PULL_RIGHT = "pull-right";
	//
	const SIZE_LG = "lg";
	const SIZE_2X = "2x";
	const SIZE_3X = "3x";
	const SIZE_4X = "4x";
	const SIZE_5X = "5x";
	//
	const ROTATE_90 = "rotate-90";
	const ROTATE_180 = "rotate-180";
	const ROTATE_270 = "rotate-270";
	//
	const FLIP_HORIZONTAL = "flip-horizontal";
	const FLIP_VERTICAL = "flip-vertical";
	//
	const ROSTER_LI = 'li';
	const STACK_1X = 'stack-1x';
	const STACK_2X = 'stack-2x';

	/**
	 *
	 * @param string $name
	 * @param array  $config
	 *
	 */
	public function __construct($name, $config = []) {
		parent::__construct($config);
		Html::addCssClass($this->options, $this->prefix);
		if(!empty($name)) {
			Html::addCssClass($this->options, $this->prefix . '-' . $name);
		}
	}

	/**
	 * @inheritdoc
	 */
	public function __toString() {
		return $this->render();
	}

	/**
	 *
	 * @param string $name
	 * @param array  $params
	 *
	 * @return Icon
	 *
	 */
	public function __call($name, $params) {
		if(in_array($name, self::PARAMS)) {
			if(empty($params)) {
				if(in_array($name, ['inverse', 'spin', 'pulse', 'fw', 'li', 'border'])) {
					$params = [true];
				} else {
					$params = [null];
				}
			}
			$this->{$name} = array_shift($params);

			return $this;
		}

		return parent::__call($name, $params);
	}

	/**
	 *
	 * @return string
	 *
	 */
	public function render() {
		$options = $this->options;

		foreach(self::PARAMS as $param) {
			if(!empty($this->{$param})) {
				if(in_array($param, ['inverse', 'spin', 'pulse', 'fw', 'li', 'border',])) {
					Html::addCssClass($options, $this->prefix . '-' . $param);
				} else {
					switch($param) {
						case 'pull':
							if(in_array($this->{$param}, [self::PULL_LEFT, self::PULL_RIGHT])) {
								Html::addCssClass($options, $this->prefix . '-' . $this->{$param});
							}
							break;
						case 'size':
							if(in_array($this->{$param}, [self::SIZE_LG, self::SIZE_2X, self::SIZE_3X, self::SIZE_4X, self::SIZE_5X])) {
								Html::addCssClass($options, $this->prefix . '-' . $this->{$param});
							}
							break;
						case 'rotate':
							if(in_array($this->{$param}, [self::ROTATE_90, self::ROTATE_180, self::ROTATE_270])) {
								Html::addCssClass($options, $this->prefix . '-' . $this->{$param});
							}
							break;
						case 'flip':
							if(in_array($this->{$param}, [self::FLIP_HORIZONTAL, self::FLIP_VERTICAL])) {
								Html::addCssClass($options, $this->prefix . '-' . $this->{$param});
							}
							break;
						case 'component':
							if(in_array($this->{$param}, [self::ROSTER_LI, self::STACK_1X, self::STACK_2X])) {
								Html::addCssClass($options, $this->prefix . '-' . $this->{$param});
							}
							break;
					}
				}
			}
		}

		return Html::tag($this->tag, null, $options);
	}

	public function addCssClass($class) {
		Html::addCssClass($this->options, $class);
	}

	/**
	 *
	 * @param string $name
	 * @param array  $config
	 *
	 * @return Icon
	 *
	 */
	public static function get($name, $config = []) {
		$class = self::className();

		return new $class($name, $config);
	}

	/**
	 *
	 * @param array $config
	 *
	 * @return Stack
	 *
	 */
	public static function stack($config = []) {
		return Stack::get($config);
	}

	/**
	 *
	 * @param array $config
	 *
	 * @return Roster
	 *
	 */
	public static function roster($config = []) {
		return Roster::get($config);
	}
}