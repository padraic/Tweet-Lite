<?php

/**
 * include some common code (like we did in the 90s)
 * People still do this? ;)
 */
include_once './common.php';

/**
 * Do we already have a valid Access Token or need to go get one?
 */
if (!isset($_SESSION['TWITTER_ACCESS_TOKEN'])) {
    /**
     * Guess we need to go get one!
     */
    $token = $consumer->getRequestToken();
    $_SESSION['TWITTER_REQUEST_TOKEN'] = serialize($token);

    /**
     * Now redirect user to Twitter site so they can log in and
     * approve our access
     */
    $consumer->redirect();
}

/**
 * Got past that if block! Must have an Access Token. Let's kick out a simple
 * form for the user to submit their tweet with.
 */
// echo the xml declaration in case short tags enabled - grrr. They're
// a bloody nuisance at times.
echo '<?xml version="1.0" encoding="UTF-8"?>';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
  <head>
    <title>Tweet Lite Script</title>
    <script language="javascript" type="text/javascript">
    <!--
    function imposemax(Object)
    {
      return (Object.value.length <= 140);
    }
    -->
    </script>
  </head>
  <body>
    <?php if (isset($_GET['result']) && $_GET['result'] == 'true'): ?>
        <p style="background-color: lightgreen;">You successfully sent your tweet!</p>
    <?php elseif (isset($_GET['result']) && !empty($_GET['result'])): ?>
        <p style="background-color: red;">Oops! Tweet wasn't accepted by Twitter. Probable failure:</p>
        <div style="background-color: red;"><?php echo $_GET['result']; ?></div>
    <?php endif; ?>
    <p>All that work on Zend_Oauth, and all you do is send Tweets with it? ;)<br/><br/></p>
    <form action="tweet.php" method="post" id="statusform">
        <p>What do you want to say to Twitterland using 140 characters?</p>
        <!-- Bit of a JS hack without dumping in jsQuery to do it right,
        to impose 140 char limit. It'll prevent deleting when limit reached -->
        <textarea name="status" id="status" rows="2" cols="70%" onkeypress="return imposemax(this);"></textarea>
        <br/><input type="submit" id="submit" value="Tweet!"/>
    </form>
    <p><br/><br/>Click below to delete the Access Token and force start another authorisation leg:<br/>
    <a href="clear.php">Clear Access Token</a></p>
  </body>
</html>
