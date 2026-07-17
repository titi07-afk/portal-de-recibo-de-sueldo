<?php

include("conexion.php");
require 'vendor/autoload.php';
session_start();
$client = new Google_Client();
$client->setClientId("31706999358-456sm2c85d9odj94rf65f54f3nmsijlv.apps.googleusercontent.com");
$client->setClientSecret("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");
$client->setRedirectUri("http://localhost/recibosueldo/login.php");
$client->addScope("email");
$client->addScope("profile");
if (!isset($_GET["code"])) {
    $url = $client->createAuthUrl();
    header("Location: " . $url);
    exit();
}

$token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);
$client->setAccessToken($token);
$oauth = new Google_Service_Oauth2($client);
$usuario = $oauth->userinfo->get();
$correo = $usuario->email;

$sql = "SELECT * FROM empleados WHERE correo='$correo'";
$resultado = mysqli_query($conexion, $sql);
$empleado = mysqli_fetch_assoc($resultado);
if ($empleado) {
    $_SESSION["correo"] = $correo;
    header("Location: panel.php");
} else {
    echo "empleado no registrado.";
}
?>