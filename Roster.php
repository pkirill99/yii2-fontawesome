<?php
/**
 * User: Kirill Pomerantsev
 * Date: 26.02.2017
 * Time: 5:02
 */

namespace pkv\fontawesome;

use yii\base\Object;
use yii\helpers\Html;

class Roster
	extends Object
{
	public $tag = "ul";
	public $item = "li";
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
		Html::addCssClass($this->options, $this->prefix . '-ul');
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
			$content .= Html::tag($this->item, $item['icon'] . $item['text']);
		}

		return Html::tag($this->tag, $content, $this->options);
	}

	/**
	 *
	 * @param array $config
	 *
	 * @return Roster
	 *
	 */
	public static function get($config = []) {
		$class = self::className();

		return new $class($config);
	}

	/**
	 *
	 * @param string|array|Icon $icon
	 * @param string            $text
	 *
	 * @return Roster
	 *
	 */
	public function add($icon, $text) {
		$options = ['component' => Icon::ROSTER_LI];
		$item = ['text' => $text, 'icon' => null];

		if(is_string($icon)) {
			$item['icon'] = Icon::get($icon, $options);
		}
		if(is_array($icon)) {
			$item['icon'] = Icon::get(array_shift($icon), array_merge(array_shift($icon), $options));
		}
		if(is_a($icon, Icon::className())) {
			$icon->component = Icon::ROSTER_LI;
			$item['icon'] = $icon;
		}

		$this->_items[] = $item;

		return $this;
	}
}