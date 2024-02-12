<?php
session_start();
require_once '../helpers.php';

$edit_user_id = $_GET['id'];

$new_email = $_POST['new_email'];
$old_pass = $_POST['old_password'];
$new_pass = $_POST['new_password'];
$new_pass_conform = $_POST['new_password_confirm'];

$user = getUserByID($edit_user_id);

if (emailNotFree($new_email))
{
    setFlashMessage('error_edit_email', 'Пользователь с такой эл. почтой уже существует');
    redirect('/security.php?id=' . $edit_user_id);
}

if (!password_verify($old_pass, $user['password']))
{
    setFlashMessage('error_password', 'Введён неверный пароль');
    redirect('/security.php?id=' . $edit_user_id);
}

if (!passwordConfirm($new_pass, $new_pass_conform))
{
    setFlashMessage('error_password', 'Новый пароль не подтверждён');
    redirect('/security.php?id=' . $edit_user_id);
}

$new_pass_hash = password_hash($new_pass, PASSWORD_DEFAULT);

editCredentials($edit_user_id, $new_email, $new_pass_hash);

setFlashMessage('success_edit_credentials', 'Email и пароль успешно обновлены');
redirect('/page_profile.php?id=' . $edit_user_id);
