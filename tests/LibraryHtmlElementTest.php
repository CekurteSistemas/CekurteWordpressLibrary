<?php

use Cekurte\Library\Html\Element;

/**
 * \Cekurte\Library\Html\Element Tests
 */
class LibraryHtmlElementTest extends \WP_UnitTestCase {
    
    /**
     * @var \Cekurte\Library\Html\Element
     */
    private $instance = null;

    /**
     * Método de Configuração executado antes do início de cada teste.
     * 
     * @see WP_UnitTestCase::setUp()
     */
    public function setUp() {
        parent::setUp();
       	$this->instance = new Element('div');
    }
    
    /**
     * Verifica se a propriedade "instance" é uma instância de \Cekurte\Library\Html\Element
     */
    public function testInstanceOfCekurteLibraryHtmlElement() {
    	$this->assertInstanceOf('\\Cekurte\\Library\\Html\\Element', $this->instance);
    }
    
    /**
     * Testa os atributos
     */
    public function testAttr() {
    	
    	$this->instance->attr('id', 'description');
    	 
    	$this->assertEquals('<div id="description"></div>', (string) $this->instance);
    }
    
    /**
     * Testa o atributo class
     */
    public function testAddClass() {
    	
    	$this->instance->addClass('description');
    	 
    	$this->assertEquals('<div class="description"></div>', (string) $this->instance);
    	 
    	$this->instance->addClass('box');
    	$this->instance->addClass('description');
    	$this->instance->addClass('box');
    	 
    	$this->assertEquals('<div class="description box"></div>', (string) $this->instance);
    	
    	$this->assertTrue($this->instance->hasClass('box'));
    	$this->assertFalse($this->instance->hasClass('other'));
    	
    	$this->instance->removeClass('description');
    	
    	$this->assertEquals('<div class="box"></div>', (string) $this->instance);
    }
    
    /**
     * Verifica a tag de um elemento
     */
    public function testGetTag() {
    	$this->assertEquals('div', $this->instance->getTag());
    }
    
    /**
     * Verifica a saída de um elemento
     */
    public function toStringWithoutParams() {
    	$this->assertEquals('<div></div>', (string) $this->instance);
    }
    
    /**
     * Verifica o conteúdo de um elemento
     */
    public function testContent() {
    	
    	$this->assertTrue($this->instance->contentIsEmpty());
    	$this->assertEquals('', $this->instance->getContent());
    	
    	$this->instance->append('content');
    	
    	$this->assertFalse($this->instance->contentIsEmpty());
    	$this->assertEquals('content', $this->instance->getContent());
    	
    	$this->instance->clearContent();
    	
    	$this->assertTrue($this->instance->contentIsEmpty());
    	$this->assertEquals('', $this->instance->getContent());
    	
    	$this->instance->setContent('content');
    	
    	$this->assertFalse($this->instance->contentIsEmpty());
    	$this->assertEquals('content', $this->instance->getContent());
    	
    	$this->instance->append('more');
    	 
    	$this->assertFalse($this->instance->contentIsEmpty());
    	$this->assertEquals('contentmore', $this->instance->getContent());
    	
    	$this->instance->clearContent();
    	
    	$this->assertTrue($this->instance->contentIsEmpty());
    	$this->assertEquals('', $this->instance->getContent());
    }
    
    /**
     * Verifica os dados passados para o construtor de um elemento
     */
    public function testParamsToConstruct() {
    	
    	$img = new Element('img', 'content', array('id' => 'image'));
    	 
    	$this->assertEquals('<img id="image" />', (string) $img);
    	
    	$em = new Element('em', 'content', array('class' => 'author'));
    	 
    	$this->assertEquals('<em class="author">content</em>', (string) $em);
    	
    	$this->assertTrue($em->hasClass('author'));
    }
}