<?php
session_start();
require_once '../helpers.php';

if (isNotLoginUser())
{
    redirect('/page_login.php');
}

$edit_user_id = $_GET['id'];
$edit_user = getUserByID($edit_user_id);

if (empty($edit_user))
{
    setFlashMessage('error_search_user', 'Пользователя с таким ID не существует');
    redirect('/users.php');
}

if (!isAdmin(getCurrentUser()) && !itsMe($edit_user, getCurrentUser()))
{
    setFlashMessage('error_edit', 'Можно редактировать только свой профиль');
    redirect('/users.php');
}

if (!empty($edit_user['avatar']))
{
    unlink($edit_user['avatar']);
}
userDelete($edit_user_id);


setFlashMessage('success_delete_user', 'Пользлователь удалён');

if (!itsMe($edit_user, getCurrentUser()))
{
    redirect('/users.php');
}

unset($_SESSION['user']);
redirect('/page_register.php');



