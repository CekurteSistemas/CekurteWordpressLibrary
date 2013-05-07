<?php

/**
 * Cekurte\Library Tests
 */
class LibraryTest extends WP_UnitTestCase {
    
    /**
     * @var \Cekurte\Library uma instância do plugin
     */
    private $plugin = null;

    public function setUp() {
        parent::setUp();
       	$this->plugin = $GLOBALS['cekurte-library'];
    }
    
    /**
     * Verifica se o plugin é uma instância de \Cekurte\Library
     */
    public function testInstanceOfCekurteLibrary() {
    	$this->assertInstanceOf('\\Cekurte\\Library', $this->plugin);
    }
}