<?php
/**
 * User: Kirill Pomerantsev
 * Date: 26.02.2017
 * Time: 3:53
 */

namespace pkv\fontawesome;

use yii\base\Object;
use yii\helpers\Html;

class Stack
	extends Object
{
	public $tag = "span";
	public $prefix = Icon::PREFIX;
	public $options = [];
	//
	private $_items = [];

	/**
	 *
	 * @param array $config
	 *
	 */
	public function __construct($config = []) {
		parent::__construct($config);
		Html::addCssClass($this->options, $this->prefix . '-stack');
	}

	/**
	 *
	 * @return string
	 *
	 */
	public function __toString() {
		return $this->render();
	}

	/**
	 *
	 * @return string
	 *
	 */
	public function render() {
		$content = '';
		foreach($this->_items as $item) {
			$content .= (string)$item;
		}

		return Html::tag($this->tag, $content, $this->options);
	}

	/**
	 *
	 * @param array $config
	 *
	 * @return Stack
	 *
	 */
	public static function get($config = []) {
		$class = self::className();

		return new $class($config);
	}

	/**
	 *
	 * @param string|array|Icon $icon
	 *
	 * @return Stack
	 *
	 */
	public function on($icon) {
		$this->addItem($icon, Icon::STACK_2X);

		return $this;
	}

	/**
	 *
	 * @param string|array|Icon $icon
	 *
	 * @return Stack
	 *
	 */
	public function in($icon) {
		$this->addItem($icon, Icon::STACK_1X);

		return $this;
	}

	/**
	 *
	 * @param string|array|Icon $icon
	 * @param string            $size
	 *
	 * @return Stack
	 *
	 */
	private function addItem($icon, $size) {
		$options = ['component' => $size];

		if(is_string($icon)) {
			$this->_items[] = Icon::get($icon, $options);
		}
		if(is_array($icon)) {
			$this->_items[] = Icon::get(array_shift($icon), array_merge(array_shift($icon), $options));
		}
		if(is_a($icon, Icon::className())) {
			$icon->component = $size;
			$this->_items[] = $icon;
		}

		return $this;
	}
}