<?php

namespace Cekurte;

if( !defined('ABSPATH') ) exit;

/*
Plugin Name: 	Cekurte Library
Plugin URI: 	http://sistemas.cekurte.com/portfolio/wp/cekurte_library
Description: 	Permite a utilização da biblioteca de Classes da Cekurte Sistemas para Wordpress.
Version: 		1.0
Author: 		Cekurte Sistemas
Author URI: 	http://sistemas.cekurte.com
*/

if( !class_exists('\\Cekurte\\Library') ) :

/**
 * Carrega a biblioteca de classes da Cekurte Sistemas
 */
class Library {
    
    /**
     * Adiciona um hook na inicialização do Wordpress
     */
    public function __construct() {
    	add_action('init', array($this, 'init'), 5);
    }
    
    /**
     * Inicializa a biblioteca de classes registrando um autoloader
     */
    public function init() {
    	require realpath(dirname(__FILE__) . '/autoloader.php');
    }
}

$GLOBALS['cekurte-library'] = new \Cekurte\Library();

endif;