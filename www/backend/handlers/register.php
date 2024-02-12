<?php
session_start();
require_once '../helpers.php';

$email = $_POST['email'];
$password = $_POST['password'];

if (emailNotFree($email))
{
    setFlashMessage('error_register', 'Пользователь с такой эл. почтой уже существует');
    redirect('/page_register.php');
}

addUserToDB($email, $password);
setFlashMessage('success_register', 'Вы были успешно зарегестрированы');
redirect('/page_login.php');