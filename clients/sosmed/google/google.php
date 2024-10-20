<?php
require_once 'src/Google_Client.php';
require_once 'src/contrib/Google_Oauth2Service.php';

session_start();

$client = new Google_Client();
$client->setApplicationName("Google+ PHP Starter Application");
// Visit https://code.google.com/apis/console to generate your
// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
 $client->setClientId('30939634587-nor6d1kdkmagb46u83vn6ijk5m8tl2au.apps.googleusercontent.com');
 $client->setClientSecret('SrrsCEgOSPdAPKtKTp-ElQD_');
 $client->setRedirectUri('http://localhost/lewatpasar/sosmed/google/google.php');
 $client->setDeveloperKey('AIzaSyBjhFOTkfh9tmb9RCLQb53jCQqiihrxb-o');
 $plus = new Google_Oauth2Service($client);
 $client->setScopes(array('https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/userinfo.profile'));
 //unset($_SESSION['access_token']);
if (isset($_REQUEST['logout'])) {
  unset($_SESSION['access_token']);
}

if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}

if (isset($_SESSION['access_token'])) {
  $client->setAccessToken($_SESSION['access_token']);
}

if ($client->getAccessToken()) 
{
    $userinfo = $plus->userinfo;
    print_r($userinfo->get());

} else 
{
    $authUrl = $client->createAuthUrl();
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <link rel='stylesheet' href='style.css' />
</head>
<body>
<header><h1>Google+ Sample App</h1></header>
<div class="box">

<?php if(isset($personMarkup)): ?>
<div class="me"><?php print $personMarkup ?></div>
<?php endif ?>

<?php
  if(isset($authUrl)) {
    print "<a class='login' href='$authUrl'>Connect Me!</a>";
  } else {
   print "<a class='logout' href='?logout'>Logout</a>";
  }
?>
</div>
</body>
</html>