<?php

/**
 * include some common code (like we did in the 90s)
 * People still do this? ;)
 */
include_once './common.php';

/**
 * Clear the Access Token to force the OAuth protocol to rerun
 */
$_SESSION['TWITTER_ACCESS_TOKEN'] = null;

/**
 * Redirect back to index and the protocol legs should run once again
 */
header('Location: ' . URL_ROOT . '/index.php');
