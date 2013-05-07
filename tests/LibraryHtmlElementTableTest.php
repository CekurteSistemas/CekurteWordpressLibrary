<?php

use Cekurte\Library\Html\Element\Table;

/**
 * Cekurte\Library\Html\Element\Table Tests
 */
class LibraryHtmlElementTableTest extends \WP_UnitTestCase {
    
    /**
     * @var \Cekurte\Library\Html\Element\Table
     */
    private $instance = null;

    public function setUp() {
        parent::setUp();
       	$this->instance = new Table();
    }
    
    /**
     * Testa se a propriedade "instance" é uma instância de \Cekurte\Library\Html\Element\Table
     */
    public function testInstanceOfCekurteLibraryHtmlElementTable() {
    	$this->assertInstanceOf('\\Cekurte\\Library\\Html\\Element\\Table', $this->instance);
    }
    
    /**
     * Verifica os dados passados para o construtor de um elemento
     */
    public function testParamsToConstruct() {
    	
    	$columns = array('nome' => 'Autor', 'sexo' => 'Sexo');
    	
    	$data = array(
    		'nome' => array(
	    		'Joao Paulo',
	    		'Elisete',
	    		'Lucas'		
    		),
    		'sexo' => array(
    			'Masculino',
    			'Femenino',
    			'Masculino',		
    		)
    	);
    	
    	$this->assertTrue($this->instance->columnsIsEmpty());
    	$this->assertTrue($this->instance->dataIsEmpty());
    	
    	$this->assertEquals(array(), $this->instance->getColumns());
    	$this->assertEquals(array(), $this->instance->getData());
    	
    	$this->instance
    		->setColumns($columns)
    		->setData($data)
    	;
    	
    	$this->assertFalse($this->instance->columnsIsEmpty());
    	$this->assertFalse($this->instance->dataIsEmpty());
    	 
    	$this->assertEquals($columns, $this->instance->getColumns());
    	$this->assertEquals($data, $this->instance->getData());
    	
    	$this->instance->addClass('table-ordened');
    	
    	$this->assertEquals('<table class="table-ordened"><thead><tr><th>Autor</th><th>Sexo</th></tr></thead><tbody><tr><td>Joao Paulo</td><td>Masculino</td></tr><tr><td>Elisete</td><td>Femenino</td></tr><tr><td>Lucas</td><td>Masculino</td></tr></tbody></table>', (string) $this->instance);
    
    	$this->instance->setTemplate('thead_open', '<thead class="header">');
    	
    	$this->assertEquals('<table class="table-ordened"><thead class="header"><tr><th>Autor</th><th>Sexo</th></tr></thead><tbody><tr><td>Joao Paulo</td><td>Masculino</td></tr><tr><td>Elisete</td><td>Femenino</td></tr><tr><td>Lucas</td><td>Masculino</td></tr></tbody></table>', (string) $this->instance);
    }
}