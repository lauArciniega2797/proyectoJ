<?php
session_start();
include("../helpers/connection.php");
if(isset($_GET['action'])){
    $action = $_GET['action'];
}

$res = array('error' => false);

if($action == 'login'){
    $login = false;
    $data = $_POST;
    $usuario = $data['usuario'];
    $pass = $data['password'];

    if($usuario == $usuario_login and $pass == $password_login){
        $_SESSION['usuario'] = $usuario;
        $login = true;
    }

    $res['login_access'] = $login;
}

if($action == 'closeSesion'){
    if(session_destroy()) {
        $res['destroyed'] = true;
    } else {
        $res['destroyed'] = false;
    }
}

echo json_encode($res);
die();