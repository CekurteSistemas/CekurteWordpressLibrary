<?php

use Cekurte\Library\Html\Element;
use Cekurte\Library\Html\Message;

/**
 * \Cekurte\Library\Html\Message Tests
 */
class LibraryHtmlMessageTest extends \WP_UnitTestCase {
    
    /**
     * Testa os atributos
     */
    public function testConstants() {
    	$this->assertEquals('success', Message::SUCCESS);
    	$this->assertEquals('error', Message::ERROR);
    	$this->assertEquals('info', Message::INFO);
    	$this->assertEquals('warning', Message::WARNING);
    }
    
    /**
     * Monta um template para facilitar a verificação do retorno
     * do método Message::generate.
     */
    private function getTemplate($message, $type) {
    	
    	$button = new Element('button', '×', array(
    		'type' 			=> 'button',
    		'class'			=> 'close',
    		'data-dismiss'	=> 'alert',
    	));
    	 
    	$strong = new Element('strong', ucfirst($type) . '! ');
    	 
    	$container = new Element('div');
    	
    	return (string) $container
    		->addClass('alert')
    		->addClass('alert-' . $type)
    		->append($button)
    		->append($strong)
    		->append($message)
    	;
    }
    
    /**
     * Testa o retorno do método generate
     */
    public function testGenerateWithDefaultParams() {
    	
    	$myMessage = 'my message';
    	
    	$this->assertEquals($this->getTemplate($myMessage, Message::SUCCESS), Message::generate($myMessage));
    }
    
    /**
     * Testa o retorno do método generate para o tipo success
     */
    public function testGenerateToSuccess() {
    	 
    	$myMessage 	= 'my message';
    	$type 		= Message::SUCCESS;
    	 
    	$this->assertEquals($this->getTemplate($myMessage, $type), Message::generate($myMessage, $type));
    }
    
    /**
     * Testa o retorno do método generate para o tipo error
     */
    public function testGenerateToError() {
    
    	$myMessage 	= 'my message';
    	$type 		= Message::ERROR;
    
    	$this->assertEquals($this->getTemplate($myMessage, $type), Message::generate($myMessage, $type));
    }
    
    /**
     * Testa o retorno do método generate para o tipo info
     */
    public function testGenerateToInfo() {
    
    	$myMessage 	= 'my message';
    	$type 		= Message::INFO;
    
    	$this->assertEquals($this->getTemplate($myMessage, $type), Message::generate($myMessage, $type));
    	
    	$this->assertEquals($this->getTemplate($myMessage, Message::INFO), Message::generate($myMessage, 'other'));
    }
    
    /**
     * Testa o retorno do método generate para o tipo warning
     */
    public function testGenerateToWarning() {
    
    	$myMessage 	= 'my message';
    	$type 		= Message::WARNING;
    
    	$this->assertEquals($this->getTemplate($myMessage, $type), Message::generate($myMessage, $type));
    }
    
    public function testLoadTwitterBootstrap() {
    	/*
    	add_action('wp_print_scripts', function() {
    	
    	});
    	
    	add_action('wp_print_styles', function() {
    	
    	});
    	
    	echo wp_print_scripts();
    	echo wp_print_styles();
    	*/
    }
    
    /**
     * Testa a saída do método Message::show()
     */
    public function testShow() {
    	
    	$myMessage 	= 'my message';
    	$type 		= Message::ERROR;
    	
    	$this->expectOutputString($this->getTemplate($myMessage, $type));
    	
    	Message::show($myMessage, $type);
    }
}