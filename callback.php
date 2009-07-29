<?php

/**
 * include some common code (like we did in the 90s)
 * People still do this? ;)
 */
include_once './common.php';

/**
 * Someone's knocking at the door using the Callback URL - if they have
 * some GET data, it might mean that someone's just approved OAuth access
 * to their account, so we better exchange our current Request Token
 * for a newly authorised Access Token. There is an outstanding Request Token
 * to exchange, right?
 */
if (!empty($_GET) && isset($_SESSION['TWITTER_REQUEST_TOKEN'])) {
    $token = $consumer->getAccessToken($_GET, unserialize($_SESSION['TWITTER_REQUEST_TOKEN']));
    $_SESSION['TWITTER_ACCESS_TOKEN'] = serialize($token);

    /**
     * Now that we have an Access Token, we can discard the Request Token
     */
    $_SESSION['TWITTER_REQUEST_TOKEN'] = null;

    /**
     * With Access Token in hand, let's try accessing the client again
     */
    header('Location: ' . URL_ROOT . '/index.php');
} else {
    /**
     * Mistaken request? Some malfeasant trying something?
     */
    exit('Invalid callback request. Oops. Sorry.');
}
