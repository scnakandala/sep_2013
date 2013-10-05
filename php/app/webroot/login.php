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
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="">
        
        <title>Synoptic Assesment Panel Builder</title>

        <!-- Bootstrap core CSS -->
        <link href="http://getbootstrap.com/dist/css/bootstrap.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="http://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">            
            <?php
            if (isset($authUrl)) {
                print "<div class='header'>";
                print "<ul class='nav nav-pills pull-right'>";
                print "</ul>";
                print "<h3 class='text-muted'>Department of Computer Science & Engineering <br> University of Moratuwa</h3>";
                print "</div>";
                print "<div class='jumbotron'>";
                print "<h1>Synoptic Assesment Panel Builder</h1>";
                print "<p><a class='btn btn-lg btn-success' href='$authUrl'>Sign up using Google</a></p>";
                print "</div>";
            } else {
                print "<div class='navbar navbar-default navbar-fixed-top'>";
                print "<div class='container'>";
                print "<div class='navbar-header'>";
                $image = $_SESSION['img'];
                print "<div class='navbar-brand'><img src='$image?sz=50'></div>";
                $name = $_SESSION['name'];
                $role = "(" . str_replace("_", " ", strtolower($_SESSION['role'])) . ")";
                print "<div class='navbar-brand'>Welcome $name <br> $role</div>";
                print "</div>";
                print "<div class='navbar-collapse collapse'>";
                print "<ul class='nav navbar-nav navbar-right'>";
                print "<li class='active'><a href='?logout'>Logout</a></li>";
                print "</ul><hr></div></div>";
                if ($_SESSION['role'] == 'INTERNAL_EVALUATOR' || $_SESSION['role'] == 'EXTERNAL_EVALUATOR') {
                    include_once './evaluator.php';
                } else if ($_SESSION['role'] == 'STUDENT') {
                    include_once './student.php';
                }
            }
            ?>
            <div class="footer">
                <p style="text-align:center;">Developed by: <a href="http://www.linkedin.com/profile/view?id=203565354">Supun Nakandala</a></p>
            </div>
        </div> 
    </body>
</html>