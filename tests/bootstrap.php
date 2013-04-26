<?php

// Load the test environment
// https://github.com/nb/wordpress-tests

$path = realpath(dirname(__FILE__) . '/../../wordpress-tests/bootstrap.php');

if (file_exists($path)) {
    $GLOBALS['wp_tests_options'] = array(
        'active_plugins' => array('cekurte-library/Library.php')
    );
    require_once $path;
} else {
	exit("Couldn't find wordpress-tests/bootstrap.phpn");
}