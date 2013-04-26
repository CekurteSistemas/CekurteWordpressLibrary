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

require realpath(dirname(__FILE__) . '/autoloader.php');

class Library {
    
    /**
     * Library
     */
    public function __construct() {
    	add_action('init', array($this, 'init'));
    }
    
    public function init() {
    	
    }
}

endif;