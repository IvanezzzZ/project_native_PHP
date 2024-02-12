<?php
session_start();
require_once '../helpers.php';

$email = $_POST['email'];
$password = $_POST['password'];

if (!login($email, $password))
{
    setFlashMessage('error_login', 'Неверный логин или пароль');
    redirect('/page_login.php');
}

redirect('/users.php');