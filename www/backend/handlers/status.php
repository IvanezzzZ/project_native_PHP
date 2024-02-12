<?php
session_start();
require_once '../helpers.php';

$edit_user_id = $_GET['id'];
$edit_user = getUserByID($edit_user_id);

$new_status = $_POST['status'];

updateUserToDB($edit_user_id, 'status', $new_status);

setFlashMessage('success_edit_status', 'Статус успешно обновлен');
redirect('/page_profile.php?id=' . $edit_user_id);