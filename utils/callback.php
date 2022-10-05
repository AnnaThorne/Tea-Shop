<?php
require __DIR__ . '/ghLogin.php';

if (session_status() !== PHP_SESSION_ACTIVE) session_start();
if (!empty($_GET)) {
    $code = $_GET['code'];
    if ($code == "") {
        header('Location ../login.php');
        exit();
    }
    $ch = curl_init();
    $postParams = [
        'client_id' => OAUTH2_CLIENT_ID,
        'client_secret' => OAUTH2_CLIENT_SECRET,
        'code' => $code,
    ];
    curl_setopt($ch, CURLOPT_URL, $tokenURL);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postParams);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
    $response = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($response);
    if($data->access_token != ""){
        $_SESSION['access_token'] = $data->access_token;
        header('Location: ./gUser.php');
        exit();
    }
}
