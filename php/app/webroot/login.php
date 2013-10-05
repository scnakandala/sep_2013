<?php
/**
 * Author : Supun Nakandala
 * Date : 10 September 2013
 * 
 * This is the index page. It handles login using Google OAuth2
 */
require_once './google-api-php-client/src/Google_Client.php';
require_once './google-api-php-client/src/contrib/Google_Oauth2Service.php';
require_once './config.php';
require_once './dbfunctions.lib.php';

session_start();
// Visit https://code.google.com/apis/console?api=plus to generate your
// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
$client = new Google_Client();
$client->setApplicationName("Google UserInfo PHP Starter Application");
$client->setClientId('604606516848.apps.googleusercontent.com');
$client->setClientSecret('CWovFOGBagmpNzWX_aG5kF-k');
$client->setRedirectUri('http://tale-scn.rhcloud.com/');
$client->setDeveloperKey('AIzaSyDE2o-akjQrFc9IkXQfWGiDAp9KMIt5hPA');
$oauth2 = new Google_Oauth2Service($client);

if (isset($_SESSION['token'])) {
    $client->setAccessToken($_SESSION['token']);
} else {

    if (isset($_GET['code'])) {
        $client->authenticate($_GET['code']);
        $_SESSION['token'] = $client->getAccessToken();
    }
}

if (isset($_REQUEST['logout'])) {
    unset($_SESSION['token']);
    $client->revokeToken();
}

if ($client->getAccessToken()) {
    $user = $oauth2->userinfo->get();
    // These fields are currently filtered through the PHP sanitize filters.
    // See http://www.php.net/manual/en/filter.filters.sanitize.php
    $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
    $name = filter_var($user['name'], FILTER_SANITIZE_STRING);
    $img = "";
    if (isset($user['picture'])) {
        $img = filter_var($user['picture'], FILTER_VALIDATE_URL);
    }
    $personMarkup = "
          <table border='0'>
                  <tr>
                        <td rowspan='2'>
                                <img src='$img?sz=50'>
                        </td>
                        <td>
                                Welcome $name
                        </td>
                  </tr>
                  <tr>
                        <td>
                                ( $email )
                        </td>
                  </tr>
          </table>
          ";
    // The access token may have been updated lazily.
    $_SESSION['token'] = $client->getAccessToken();
    $_SESSION['client'] = $client;
    $_SESSION['oauth2'] = $oauth2;
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;
    $_SESSION['img'] = $img;

    updateUserInformation();
} else {
    $authUrl = $client->createAuthUrl();
}
?>
<html>
    <head>
        <title>Synoptic Assessment Panel Builder</title> 
    </head>
    <body>
        <header>
            <h1>Synoptic Assessment Panel Builder</h1>
            <b>Department of Computer Science & Engineering</b>
        </header>
        <?php
        if (isset($personMarkup)) {
            print "$personMarkup";
        }
        if (isset($authUrl)) {
            print "<a class='login' href='$authUrl'>Click here to log in using Google ID</a>";
        } else {
            print "<a class='logout' href='?logout'>Logout</a>";
            print "<br>";
            if ($_SESSION['role'] == 'INTERNAL_EVALUATOR' || $_SESSION['role'] == 'EXTERNAL_EVALUATOR') {
                include_once './evaluator.php';
            } else if ($_SESSION['role'] == 'STUDENT') {
                include_once './student.php';
            }
        }
        ?>
    </body>
</html>