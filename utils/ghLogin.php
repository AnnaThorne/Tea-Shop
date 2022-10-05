<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
define('OAUTH2_CLIENT_ID', '3e05d4dc284a5ee26449');
define('OAUTH2_CLIENT_SECRET', '295d8247f12c21e749d82fabfe91d91f90ae7822');

$authorizeURL = 'https://github.com/login/oauth/authorize';
$tokenURL = 'https://github.com/login/oauth/access_token';
$userURL = 'https://api.github.com/user';
$apiURLBase = 'https://api.github.com/';
?>