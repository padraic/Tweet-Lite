<?php

/**
 * include some common code (like we did in the 90s)
 * People still do this? ;)
 */
include_once './common.php';

/**
 * Check for a POSTed status message to send to Twitter
 */
if (!empty($_POST) && isset($_POST['status'])
&& isset($_SESSION['TWITTER_ACCESS_TOKEN'])) {
    /**
     * Easiest way to use OAuth now that we have an Access Token is to use
     * a preconfigured instance of Zend_Http_Client which automatically
     * signs and encodes all our requests without additional work
     */
    $token = unserialize($_SESSION['TWITTER_ACCESS_TOKEN']);
    $client = $token->getHttpClient($configuration);
    $client->setUri('http://twitter.com/statuses/update.json');
    $client->setMethod(Zend_Http_Client::POST);
    $client->setParameterPost('status', $_POST['status']);
    $response = $client->request();

    /**
     * Check if the json response refers to our tweet details (assume it
     * means it was successfully posted). API gurus can correct me.
     */
    $data = json_decode($response->getBody());
    $result = $response->getBody();
    if (isset($data->text)) {
        $result = 'true';
    }
    /**
     * Tweet sent (hopefully), redirect back home...
     */
    header('Location: ' . URL_ROOT . '?result=' . $result);
} else {
    /**
     * Mistaken request? Some malfeasant trying something?
     */
    exit('Invalid tweet request. Oops. Sorry.');
}
