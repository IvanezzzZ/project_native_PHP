<?php
session_start();
require_once '../helpers.php';

$edit_user_id = $_GET['id'];

foreach ($_POST as $key => $data)
{
    updateUserToDB($edit_user_id, $key, $data);
}

setFlashMessage('success_update_user', 'Информация успешно обновлена');
redirect('/page_profile.php?id=' . $edit_user_id);


