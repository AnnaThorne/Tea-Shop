<?php
require __DIR__ . '/ghLogin.php';
require __DIR__ . '/mailSender.php';
require dirname(__DIR__, 1) . '/db/UsersDB.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
$accessToken = $_SESSION['access_token'];
$authHeader = 'Authorization: token ' . $accessToken;
$userAgentHeader = 'User-Agent: TeaShop';
$userEmailURL = 'https://api.github.com/user/emails';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $userEmailURL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', $authHeader, $userAgentHeader));
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response);
$email = $data[0]->email;

$usersDB = new UsersDB();
$existingUser = $usersDB->fetchByEmail($email)[0];
if ($existingUser) {
    if (empty($existingUser['password'])) {
        $_SESSION['id'] = $existingUser['user_id'];
        $_SESSION['email'] = $existingUser['email'];
        $_SESSION['privilege'] = $existingUser['privilege'];
        setcookie('email', $email, time() + 3600,'/');
        header("Location: ../index.php");
        exit();
    } else {
        echo ('This email is already in use for a different account.');
        exit();
    }
} else {
    $usersDB->create(['email' => $email, 'password' => "", 'privilege' => 1]);
    $sender = new MailSender();
    $sender->sendMail($email, 'Registration successful!', 'TeaShop registration');

    $_SESSION['id'] = $existingUser['user_id'];
    $_SESSION['email'] = $existingUser['email'];
    $_SESSION['privilege'] = $existingUser['privilege'];
    setcookie('email', $email, time() + 3600, '/');
    header("Location: ../index.php");
    exit();
}
