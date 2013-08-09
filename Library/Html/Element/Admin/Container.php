<?php

namespace Cekurte\Library\Html\Element\Admin;

use \Cekurte\Library\Html\Element;
use \Cekurte\Library\Html\Message;

/**
 * Permite a utilização de um container no painel do Wordpress
 * 
 * @package Cekurte
 * @author Cekurte Sistemas
 * @version 1.0
 * @link http://sistemas.cekurte.com/portfolio/wp/cekurte-library
 */

class Container {

	/**
	 * @var \Cekurte\Library\Html\Element\Admin\Container
	 */
	private static $instance;

	/**
	 * Método construtor privado
	 */
	private function __construct() {
		
	}
	
	/**
	 * Recupera uma insância de \Cekurte\Library\Html\Element\Admin\Container
	 * 
	 * @return \Cekurte\Library\Html\Element\Admin\Container
	 */
	public static function getInstance() {
		if( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	public function getHeader($title, $description) {
		 
		$container = new Element('div', null, array('class' => 'wrap'));
	
		$icon = new Element('div', new Element('br'), array(
			'id' 	=> 'icon-options-general',
			'class' => 'icon32 icon32-posts-post'
		));
		 
		$title = new Element('h2', __($title, 'cekurte'));
		 
		$description = new Element('p', __($description, 'cekurte'));
		 
		return $container
			->append( $icon )
			->append( $title )
			->append( $description )
		;
	}
}