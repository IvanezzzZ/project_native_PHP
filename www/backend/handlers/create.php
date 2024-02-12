<?php
session_start();
require_once '../helpers.php';

$email    = $_POST['email'];
$password = $_POST['password'];

if (emailNotFree($email))
{
    setFlashMessage('error_create_user', 'Пользователь с такой эл. почтой уже существует');
    redirect('/create_user.php');
}

$user_id = addUserToDB($email, $password);

    if (!empty($_FILES['size']))
    {
        $file_name = $_FILES['avatar']['name'];
        $tmp_name = $_FILES['avatar']['tmp_name'];

        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_file_name = uniqid('avatar__') . '.' . $extension;
        $upload_path = '../../img/demo/avatars/' . $new_file_name;

        if (!move_uploaded_file($tmp_name, $upload_path))
        {
            setFlashMessage('error_upload_image', 'Ошибка при загрузке изображения');
            redirect('/create_user.php');
        }

        setUserAvatarToDB($user_id, $upload_path);
    }

//По моему замыслу юзер может заполнять не все поля.
//Реализовал универсальный функционал добавления данных о юзере в БД по одиночке
//В завимимости от того введены данные или нет
//Но так и не додумался как этот функционал красиво завернуть в функцию. Дайте совет пожалуйста!)

$dataAboutUser = array_diff($_POST, [$_POST['email'], $_POST['password']]);

foreach ($dataAboutUser as $key => $data)
{
    if (!empty($data))
    {
        updateUserToDB($user_id, $key, $data);
    }
}

setFlashMessage('success_create_user', 'Пользователь успешно добавлен');
redirect('/users.php');
