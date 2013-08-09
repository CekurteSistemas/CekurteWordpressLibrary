<?php

namespace Cekurte\Library\Html;

/**
 * Cria um elemento HTML
 * 
 * @package Cekurte
 * @author Cekurte Sistemas
 * @version 1.0
 * @link http://sistemas.cekurte.com/portfolio/wp/cekurte-library
 */
class Element {

	/**
	 * @var string a tag que deverá ser criada
	 */
	private $tag;
	
	/**
	 * @var array de atributos da tag
	 */
	private $attr;
	
	/**
	 * @var \Cekurte\Library\Html\Element|string o conteúdo da tag
	 */
	private $content;

	/**
	 * Cria e possibilita a inicialização dos valores da Tag
	 * 
	 * @param string $tag
	 * @param \Cekurte\Library\Html\Element|string $content
	 * @param array $attr
	 */
	public function __construct($tag, $content = null, $attr = array()) {
		$this->tag	= $tag;
		$this->attr = $attr;
		$this->setContent($content);
	}

	/**
	 * Adiciona um atributo na tag
	 * 
	 * @param string $name
	 * @param string $value
	 * 
	 * @return \Cekurte\Library\Html\Element|string métodos encadeados ou o valor da propriedade
	 */
	public function attr($name, $value = null) {
		if( $value === null ) {
			return $this->attr[$name];
		} else {
			$this->attr[$name] = $value;
			return $this;
		}
	}
	
	/**
	 * Adiciona uma classe ao elemento
	 * 
	 * @param string $class uma classe CSS
	 * 
	 * @return \Cekurte\Library\Html\Element
	 */
	public function addClass($class) {
		if( !empty($class) ) {
			if( empty($this->attr['class']) ) {
				$this->attr['class'] = $class;
			} else {
				
				$parts = explode(' ', $this->attr['class']);
				$hasClass = false;
				foreach( $parts as $part ) {
					// Já possuí esta classe
					if( $part == $class ) {
						return $this;
					}
				}
				$this->attr['class'] .= ' ' . $class;
			}
		}
		return $this;
	}
	
	/**
	 * Verifica se existe uma classe especifica configurada em um elemento
	 * 
	 * @param string $class o nome da classe CSS
	 * 
	 * @return boolean
	 */
	public function hasClass($class) {
		if( !empty($class) ) {
			if( isset($this->attr['class']) ) {
				$attrClass = explode(' ', $this->attr['class']);
				foreach( $attrClass as $className ) {
					if( $className == $class ) {
						return true;
					}
				}
			}
		}
		return false;
	}
	
	/**
	 * Remove uma classe CSS de um elemento
	 * 
	 * @param string $class o nome da classe CSS
	 * 
	 * @return \Cekurte\Library\Html\Element
	 */
	public function removeClass($class) {
		if( !empty($class) ) {
			if( isset($this->attr['class']) ) {
				$possibilities = array(
					' ' . $class,
					$class . ' '	
				);
				
				foreach($possibilities as $possibility) {
					$this->attr['class'] = str_replace($possibility, '', $this->attr['class']);
				}
			}
		}
		return $this;
	}

	/**
	 * Recupera o nome da tag
	 * 
	 * @return string o nome da tag
	 */
	public function getTag() {
		return $this->tag;
	}

	/**
	 * Adiciona um conteúdo dentro da tag
	 * 
	 * @param \Cekurte\Library\Html\Element|string $content
	 * 
	 * @return \Cekurte\Library\Html\Element
	 */
	public function append($content) {
		$this->content .= $content;
		return $this;
	}

	/**
	 * Limpa o conteúdo atual da tag e adiciona um novo conteúdo
	 * 
	 * @param \Cekurte\Library\Html\Element|string $content
	 * 
	 * @return \Cekurte\Library\Html\Element
	 */
	public function setContent($content) {
		$this->content = $content;
		return $this;
	}
	
	/**
	 * Limpa o conteúdo atual da tag
	 * 
	 * @return \Cekurte\Library\Html\Element
	 */
	public function clearContent() {
		$this->content = null;
		return $this;
	}

	/**
	 * Recupera o conteúdo da tag
	 * 
	 * @return string o conteúdo da tag
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * Verifica se existe algum conteúdo na tag
	 * 
	 * @return boolean
	 */
	public function contentIsEmpty() {
		return $this->getContent() === null;
	}

	/**
	 * Verifica se a tag possuí ou não conteúdo antes da ocorrência da tag de fechamento
	 * 
	 * @return boolean
	 */
	protected function tagHasContent() {
		$tags = array(
			'input', 'img', 'br', 'hr'
		);

		foreach( $tags as $tag ) {
			if( $tag === $this->getTag() ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Mostra o elemento
	 * 
	 * @return \Cekurte\Library\Html\Element|string
	 */
	protected function output() {

		$element = '<' . $this->getTag();
		
		if( !empty($this->attr) ) {
			foreach( $this->attr as $name => $value ) {
				$element .= ' ' . sprintf('%s="%s"', $name, $value);
			}
		}

		$element .= $this->tagHasContent() ? ' />' : sprintf('>%s</%s>', $this->getContent(), $this->getTag() );

		return $element;
	}

	/**
	 * Formata a saída como string
	 * 
	 * @return string
	 */
	public function __toString() {
		return $this->output();
	}
}