<?php

namespace Cekurte\Library\Html;
/*
use \Cekurte\Html\Script\Css;
use \Cekurte\Html\Script\Js;
*/
/**
 * Cria um elemento HTML de uma mensagem
 * 
 * @package Cekurte
 * @author Cekurte Sistemas
 * @version 1.0
 * @link http://sistemas.cekurte.com/portfolio/wp/cekurte-library
 */
class Message {

	/**
	 * @var string Mensagem de Sucesso
	 */
	const SUCCESS 	= 'success';
	
	/**
	 * @var string Mensagem de Erro
	 */
	const ERROR 	= 'error';
	
	/**
	 * @var string Mensagem informativa
	 */
	const INFO 		= 'info';
	
	/**
	 * @var string Mensagem de Alerta
	 */
	const WARNING	= 'warning';

	/**
	 * Gera um elemento de mensagem que é uma instância da classe \Cekurte\Html\Library\Element e o retorna
	 * 
	 * @param string $message Mensagem a ser apresentada
	 * @param string $type Tipo da mensagem a ser apresentada
	 * 
	 * @return \Cekurte\Html\Library\Element
	 */
	public static function generate( $message, $type = self::SUCCESS ) {

		self::loadTwitterBootstrap();
		
		$type = in_array($type, array(self::SUCCESS, self::ERROR, self::INFO, self::WARNING)) ? $type : self::INFO;

		$container = new Element('div', null, array(
			'class' => sprintf('alert alert-%s', $type)
		));

		$buttonClose = new Element('button', '×', array(
			'type' 			=> 'button',
			'class' 		=> 'close',
			'data-dismiss' 	=> 'alert',
		));

		$title = new Element('strong', __(ucfirst($type), 'cekurte') . '! ');

		return (string) $container->append( $buttonClose )->append( $title )->append( __($message, 'cekurte') );
	}
	
	/**
	 * Registra e mostra a mensagem na tela
	 * 
	 * @param string $message Mensagem a ser apresentada
	 * @param string $type Tipo da mensagem a ser apresentada
	 */
	public static function show( $message, $type = self::SUCCESS ) {
		echo self::generate($message, $type);
	}

	/**
	 * Carrega a biblioteca Twitter Bootstrap
	 */
	private function loadTwitterBootstrap() {
		/*
		$css 	= new Css( get_template_directory_uri() . '/css' );
		$js		= new Js( get_template_directory_uri() . '/js' );

		if( is_admin() ) {
			$js->enqueueToHead('bootstrap.min.js');
			$css->enqueueToHead('bootstrap.min.css');
			$css->enqueueToHead('cekurte-form.css');
		}
		*/
	}
}
