<?php
session_start();
require_once '../helpers.php';

$name = $_FILES['avatar']['name'];
$tmp_name = $_FILES['avatar']['tmp_name'];

$extension = pathinfo($name, PATHINFO_EXTENSION);
$new_name = uniqid('avatar__') . '.' . $extension;
$upload_path = '../../img/demo/avatars/' . $new_name;

$edit_user_id = $_GET['id'];
$edit_user = getUserByID($edit_user_id);

if (!move_uploaded_file($tmp_name, $upload_path))
{
    setFlashMessage('error_upload_image', 'Ошибка при загрузке изображения');
    redirect('/media.php?id=' . $edit_user_id);
}

unlink($edit_user['avatar']);

updateUserToDB($edit_user_id, 'avatar', $upload_path);

setFlashMessage('success_upload_image', 'Изображение успешно загружено');
redirect('/page_profile.php?id=' . $edit_user_id);

