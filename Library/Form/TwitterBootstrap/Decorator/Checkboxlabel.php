<?php

namespace Cekurte\Library\Form\TwitterBootstrap\Decorator;

class Checkboxlabel extends \Zend_Form_Decorator_HtmlTag
{
	public function render($content)
	{
		$element = $this->getElement();
		$separator = $this->getSeparator();

		return $content . $separator . $element->getLabel();
	}
}
