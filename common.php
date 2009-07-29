<?php

/**
 * If you haven't edited php.ini to add the Zend Framework and the
 * Zend Framework Incubator to the PHP include_path, then do so here.
 * Don't use mine!
 */
set_include_path(
    '/path/to/zf/trunk/library'
    . PATH_SEPARATOR . '/path/to/zf/incubator/library'
    . PATH_SEPARATOR . get_include_path()
);

/**
 * Make sure Zend_Oauth's Consumer is loaded
 */
require_once 'Zend/Oauth/Consumer.php';

/**
 * Start up the ol' session engine
 */
session_start();

/**
 * Include the configuration data for our OAuth Client (array $configuration)
 */
include_once './config.php';

/**
 * Setup an instance of the Consumer for use
 */
$consumer = new Zend_Oauth_Consumer($configuration);
